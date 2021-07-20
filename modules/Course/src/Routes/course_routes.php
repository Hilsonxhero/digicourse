<?php


use Course\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth', 'verified', 'auth.admin'])->prefix('dashboard')->group(function () {
    Route::resource('/courses', CourseController::class);
    Route::get('courses/{course}/accept', [CourseController::class,'accept'])->name('courses.accept');
    Route::get('courses/{course}/reject', [CourseController::class,'reject'])->name('courses.reject');
    Route::get('courses/{course}/lock', [CourseController::class,'lock'])->name('courses.lock');
    Route::get('courses/{course}/detail', [CourseController::class,'detail'])->name('courses.detail');


});

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    // course payment
    Route::post('courses/{course}/buy', [CourseController::class,'buy'])->name('courses.buy');
});
