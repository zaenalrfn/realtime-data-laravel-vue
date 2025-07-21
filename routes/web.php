<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Events\HelloWorld;

Route::get('/', function () {
    HelloWorld::dispatch();
    return Inertia::render('Welcome');
})->name('home');

Route::get('visit-count', function () {
    return Inertia::render('VisitCount');
});


Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
