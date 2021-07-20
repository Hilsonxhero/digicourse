<?php

use Dashboard\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth', 'verified','auth.admin'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});
