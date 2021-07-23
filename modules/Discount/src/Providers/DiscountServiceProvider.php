<?php


namespace Discount\Providers;


use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{

    public function register()
    {


    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/discount_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
//        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Discount');
//        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/lang');

//        Gate::policy(Course::class, CoursePolisy::class);
    }
}
