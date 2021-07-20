<?php

namespace Payment\Http\Controllers;

use Payment\Events\PaymentWasSuccessful;
use App\Http\Controllers\Controller;
use Payment\Models\Payment as PaymentModel;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function verify(Request $request)
    {


        if (isset($request->Authority)) {
            $transaction_id = $request->Authority;

        }
        $payment = PaymentModel::where('invoice_id', $transaction_id)->first();
        try {

            $amount = $payment->amount;


            $receipt = Payment::amount($amount)->transactionId($transaction_id)->verify();
            $ref_num = $receipt->getReferenceId();


            $payment->update([
                'status' => PaymentModel::STATUS_SUCCESS
//                'ref_num' => $ref_num
            ]);
            event(new PaymentWasSuccessful($payment));
            newFeedback();

        } catch (InvalidPaymentException $exception) {
            $payment->update([
                'status' => PaymentModel::STATUS_FAIL
            ]);

            newFeedback('عملیات نا موفق', 'پرداخت توسط شما لغو شد', 'error');

        }
        return redirect()->to($payment->paymentable->path());
    }


}
