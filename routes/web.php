<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::view('/', 'welcome'); 

Route::controller(UserController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard')->middleware(['auth', 'verified']);
    Route::get('/chat/{id}', 'userChat')->name('chat')->middleware(['auth', 'verified']);
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
