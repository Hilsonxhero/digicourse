<?php

use Course\Http\Controllers\SeasonController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth', 'verified', 'auth.admin'])->prefix('dashboard')->group(function () {
    Route::resource('/seasons', SeasonController::class);
    Route::post('seasons/{course}', [SeasonController::class, 'store'])->name('seasons.store');
    Route::get('seasons/{season}/accept', [SeasonController::class, 'accept'])->name('seasons.accept');
    Route::get('seasons/{season}/reject', [SeasonController::class, 'reject'])->name('seasons.reject');
});
