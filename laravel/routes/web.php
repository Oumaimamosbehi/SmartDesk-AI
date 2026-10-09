<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return redirect()->route('tickets.create');
});

Route::get('/tickets/create', [TicketController::class, 'create'])
    ->name('tickets.create');

Route::post('/tickets', [TicketController::class, 'store'])
    ->name('tickets.store');

Route::get('/dashboard', [TicketController::class, 'index'])
    ->name('tickets.index');

Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])
    ->name('tickets.edit');

Route::put('/tickets/{ticket}', [TicketController::class, 'update'])
    ->name('tickets.update');

Route::get('/chat', [ChatController::class, 'index']) ->name('chat');

Route::post('/chat/send', [ChatController::class, 'send'])
    ->name('chat.send');