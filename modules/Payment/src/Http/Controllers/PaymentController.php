<?php

namespace Payment\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Morilog\Jalali\Jalalian;
use Payment\Events\PaymentWasSuccessful;
use App\Http\Controllers\Controller;
use Payment\Models\Payment as PaymentModel;
use Illuminate\Http\Request;
use Payment\Repositories\PaymentRepo;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public $PaymentRepo;

    public function __construct(PaymentRepo $repo)
    {
        $this->PaymentRepo = $repo;
    }


    public function index(PaymentRepo $paymentRepo, Request $request)
    {
        $payments = $this->PaymentRepo
            ->searchEmail($request->email)
            ->searchAmount($request->amount)
            ->searchAfterDate(dateFromJalali($request->start_date))
            ->searchBeforeDate(dateFromJalali($request->end_date))
            ->paginate();
        $last30DaysTotal = $this->PaymentRepo->getDaysTotal(-30);
        $last30DaysBenefit = $this->PaymentRepo->getLastNDaysSiteBenefit(-30);
        $last30DaysSellerBenefit = $this->PaymentRepo->getLastNDaysSellerBenefit(-30);
        $totalSell = $this->PaymentRepo->getDaysTotal();
        $totalBenefit = $this->PaymentRepo->getLastNDaysSiteBenefit();

        $dates = collect();
        foreach (range(-30, 0) as $i) {
            $dates->put(now()->addDays($i)->format("Y-m-d"), 0);
        }
        $summery = $this->PaymentRepo->getDailySummery($dates);
        return view('Payment::index', compact(
            'payments',
            'last30DaysTotal',
            'last30DaysBenefit',
            'last30DaysSellerBenefit',
            'totalSell',
            'totalBenefit',
            'dates',
            'summery'
        ));
    }



    public function purchases()
    {
        $payments = auth()->user()->payments()->with("paymentable")->paginate();
        return view('Payment::purchases',compact('payments'));
    }

    public function verify(Request $request)
    {


        if (isset($request->Authority)) {
            $transaction_id = $request->Authority;

        }
        $payment = PaymentModel::where('invoice_id', $transaction_id)->first();
        try {

            $amount = $payment->amount;
//            dd(gettype($amount));


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
