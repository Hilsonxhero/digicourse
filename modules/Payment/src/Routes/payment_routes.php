<?php

use Illuminate\Support\Facades\Route;
use Payment\Http\Controllers\PaymentController;
use Payment\Http\Controllers\SettlementController;


Route::middleware(['web'])->group(function () {
    Route::get('/payment/{gateway}/callback', [PaymentController::class, 'verify'])->name('payment.verify');
});


Route::middleware(['web'])->prefix('/dashboard')->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/purchases', [PaymentController::class, 'purchases'])->name('purchases.index');
    Route::resource('/settlements', SettlementController::class);
});



