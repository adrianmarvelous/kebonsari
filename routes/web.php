<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LayananController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {

    // Dashboard main page
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Grouped resource routes
    Route::resource('users', UserController::class);
    Route::resource('layanan', LayananController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
