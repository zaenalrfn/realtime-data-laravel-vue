<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Events\HelloWorld;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    HelloWorld::dispatch();
    return Inertia::render('Welcome');
})->name('home');

Route::post('/messages',   [MessageController::class, 'store'])->name('messages.store');

Route::get('visit-count', function () {
    return Inertia::render('VisitCount');
});


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
