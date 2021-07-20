<?php


use Illuminate\Support\Facades\Route;
use RolePermissions\Http\Controllers\RolePermissionsController;

Route::prefix('dashboard')->middleware(['web', 'auth', 'verified', 'auth.admin'])
    ->group(function () {
        Route::resource('role-permissions', RolePermissionsController::class)->except('show');
    });
