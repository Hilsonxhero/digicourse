<?php

namespace Payment\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Payment\Events\PaymentWasSuccessful;
use Payment\Listeners\AddSellerShareToHisAccount;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PaymentWasSuccessful::class => [
            AddSellerShareToHisAccount::class
        ]
    ];
}
