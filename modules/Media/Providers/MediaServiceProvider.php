<?php

namespace Media\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()

    {


        $this->loadRoutesFrom(__DIR__ . '/../Routes/media_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
//        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
//        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Media');
//        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/lang');
        $this->mergeConfigFrom(__DIR__ . '/../Config/media.php', 'MediaFile');
    }
}
