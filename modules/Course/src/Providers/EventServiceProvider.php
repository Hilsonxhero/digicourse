<?php
namespace Course\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Course\Listeners\RegisterUserInTheCourse;
use Payment\Events\PaymentWasSuccessful;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PaymentWasSuccessful::class => [
            RegisterUserInTheCourse::class
        ]
    ];
}
