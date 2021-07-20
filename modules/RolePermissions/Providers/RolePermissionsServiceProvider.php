<?php

namespace RolePermissions\Providers;

use Course\Models\Course;
use Course\Policies\CoursePolisy;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use RolePermissions\database\seeders\RolePermissionsTableSeeder;
use RolePermissions\Models\Permission;

class RolePermissionsServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/role_permissions_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadFactoriesFrom(__DIR__ . '/../database/factories');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'RolePermissions');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/lang');
        DatabaseSeeder::$seeders[] = RolePermissionsTableSeeder::class;

        Gate::before(function ($user) {
            return $user->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN) ? true : null;
        });

    }

}
