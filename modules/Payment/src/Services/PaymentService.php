<?php


namespace Payment\Services;


use Payment\Models\Payment as PaymentModel;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Payment\Repositories\PaymentRepo;
use User\Models\User;

class PaymentService
{

    public static function generate($amount, $paymentable, User $buyer)
    {
        if ($amount <= 0 || is_null($paymentable->id) || is_null($buyer->id)) return false;

        $gateway_name = "zarinpal";
        $invoice = (new Invoice)->amount($amount);
//        $invoice->via($gateway_name);
        return Payment::purchase($invoice, function ($driver, $transactionId) use ($amount, $paymentable, $gateway_name, $buyer) {

            if (!is_null($paymentable->percent)) {
                $seller_percent = $paymentable->percent;
                $seller_share = ($amount / 100) * $seller_percent;
                $site_share = $amount - $seller_share;
            } else {
                $seller_percent = $seller_share = $site_share = 0;

            }
            resolve(PaymentRepo::class)->store([
                'buyer_id' => $buyer->id,
                'paymentable_id' => $paymentable->id,
                'paymentable_type' => get_class($paymentable),
                'amount' => $amount,
                'invoice_id' => $transactionId,
                'gateway' => $gateway_name,
                'status' => PaymentModel::STATUS_PENDING,
                'seller_percent' => $seller_percent,
                'seller_share' => $seller_share,
                'site_share' => $site_share,
            ]);
//            dd($order->payment->amount);
        })->pay()->render();
    }

}
