<?php

namespace Discount\Providers;

use Discount\Listeners\UpdateUsedDiscountForPayment;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Payment\Events\PaymentWasSuccessful;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PaymentWasSuccessful::class => [
            UpdateUsedDiscountForPayment::class
        ]
    ];
}
