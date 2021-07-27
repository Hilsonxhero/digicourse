<?php

use Discount\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth', 'verified', 'auth.admin'])->prefix('/dashboard')->group(function () {
    Route::resource('/discounts', DiscountController::class);
});


//throttle:6,1
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/discounts/{code}/{course}/check', [DiscountController::class, 'check'])->name('discounts.check');
});





