<?php

namespace Payment\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    public function register()
    {


    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/payment_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
//        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
//        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Course');
//        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/lang');

//        Gate::policy(Course::class, CoursePolisy::class);
    }

}
