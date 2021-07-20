<?php

use Course\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web', 'auth', 'verified', 'auth.admin'])->prefix('dashboard')->group(function () {
    Route::resource('/lessons', LessonController::class);
    Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('courses/{course}/lessons/', [LessonController::class, 'store'])->name('lessons.store');

    // edit && update
    Route::get('courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('courses/{course}/lessons/{lesson}/edit', [LessonController::class, 'update'])->name('lessons.update');

    Route::delete('courses/{course}/lessons/', [LessonController::class, 'destroyMultiple'])->name('lessons.destroyMultiple');
    // accept all lessons
    Route::put('courses/{course}/lessons/acceptAll', [LessonController::class, 'acceptAll'])->name('lessons.acceptAll');

    // accept selected lessons
    Route::put('courses/{course}/lessons/acceptMultiple', [LessonController::class, 'acceptMultiple'])->name('lessons.acceptMultiple');

    // accept selected lessons
    Route::put('courses/{course}/lessons/rejectMultiple', [LessonController::class, 'rejectMultiple'])->name('lessons.rejectMultiple');

    // accept lesson
    Route::post('lessons/{season}/accept', [LessonController::class, 'accept'])->name('lessons.accept');
    // reject lesson
    Route::post('lessons/{season}/reject', [LessonController::class, 'reject'])->name('lessons.reject');
});
