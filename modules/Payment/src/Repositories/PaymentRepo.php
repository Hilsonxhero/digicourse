<?php

namespace Payment\Repositories;

use Payment\Models\Payment;
use User\Models\User;

class PaymentRepo
{

    public function store($data)
    {
        return Payment::query()->create([
            'buyer_id' => $data['buyer_id'],
            'paymentable_id' => $data['paymentable_id'],
            'paymentable_type' => $data['paymentable_type'],
            'amount' => $data['amount'],
            'invoice_id' => $data['invoice_id'],
            'gateway' => $data['gateway'],
            'status' => $data['status'],
            'seller_percent' => $data['seller_percent'],
            'seller_share' => $data['seller_share'],
            'site_share' => $data['site_share'],
        ]);
    }

}