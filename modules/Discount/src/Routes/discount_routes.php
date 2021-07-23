<?php

use Discount\Http\Controllers\DiscountController;
use Illuminate\Support\Facades\Route;



Route::middleware(['web','auth','verified','auth.admin'])->prefix('/dashboard')->group(function () {
    Route::resource('/discounts', DiscountController::class);
});



