<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Web\LayananController as WebLayananController;

Route::get('/', function () {
    return view('index');
});
Route::get('/layanan', [WebLayananController::class, 'index'])->name('web.layanan.index');
Route::get('/layanan/{sektor}', [WebLayananController::class, 'sektor'])->name('web.layanan.sektor');
Route::get('/layanan/detail/{id}', [WebLayananController::class, 'detail'])->name('web.layanan.detail');
Route::get('/search-layanan', [WebLayananController::class, 'search'])->name('web.layanan.search');


Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {

    // Dashboard main page
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Grouped resource routes
    Route::resource('users', UserController::class);
    // web.php
    Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update_role');

    Route::resource('layanan', LayananController::class);
    Route::resource('info', InfoController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
