<?php

use Illuminate\Support\Facades\Route;
use Ticket\Http\Controllers\TicketController;


Route::middleware(['web', 'auth', 'verified', 'auth.admin'])->prefix('dashboard')->group(function () {
    Route::resource("/tickets", TicketController::class);
    // store reply
    Route::post("/tickets/{ticket}/reply", [TicketController::class, 'reply'])->name("tickets.reply");

    // reject ticket
    Route::post('tickets/{ticket}/reject', [TicketController::class, 'reject'])->name('tickets.reject');
});
