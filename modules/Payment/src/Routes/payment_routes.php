<?php
use Illuminate\Support\Facades\Route;
use Payment\Http\Controllers\PaymentController;


Route::middleware(['web'])->group(function () {
    Route::get('/payment/{gateway}/callback', [PaymentController::class, 'verify'])->name('payment.verify');
});


