<?php


use Front\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web'])->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('home');
    Route::get('courses/{course:slug}', [FrontController::class, 'CoursePage'])->name('course.page.show');
    Route::get('tutors/{name}', [FrontController::class, 'tutorPage'])->name('tutor.page.show');
});
