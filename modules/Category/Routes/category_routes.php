<?php


use Category\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth', 'verified', 'auth.admin','permission:manage categories'])->prefix('dashboard')->group(function () {
    Route::resource('/categories', CategoryController::class);
});
