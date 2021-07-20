<?php


namespace User\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use User\Http\Middleware\StoreUserIp;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;
use User\database\seeders\UserTableSeeder;
use User\Models\User;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {

        config()->set('auth.providers.users.model', User::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/lang');
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'User\database\factories\\' . class_basename($modelName) . 'Factory';
        });

        DatabaseSeeder::$seeders[] = UserTableSeeder::class;


    }
}
