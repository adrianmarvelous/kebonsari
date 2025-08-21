<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\InfoController;
use App\Http\Controllers\Admin\PengunjungController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Web\LayananController as WebLayananController;
use App\Http\Controllers\Web\InformasiUmumController;

Route::get('/', function () {
    return view('index');
})->name('index'); // give it a name

Route::post('/layanan', [WebLayananController::class, 'index'])->name('web.layanan.index');
Route::get('/layanan/{sektor}', [WebLayananController::class, 'sektor'])->name('web.layanan.sektor');
Route::get('/layanan/detail/{id}', [WebLayananController::class, 'detail'])->name('web.layanan.detail');
Route::get('/layanan/detail/{id}/klik_app', [WebLayananController::class, 'klik_app'])->name('web.layanan.klik_app');
Route::get('/search-layanan', [WebLayananController::class, 'search'])->name('web.layanan.search');

Route::get('/informasi-umum', [InformasiUmumController::class, 'informasi_umum'])->name('web.informasi_umum');
Route::get('/informasi-umum/detail/{id}', [InformasiUmumController::class, 'detail'])->name('web.informasi_umum.detail');

Route::post('/visitor/session/destroy', function () {
    session()->forget(['visitor_nama', 'visitor_alamat']);
    return redirect()->route('index')
        ->with('success', 'Sesi visitor berhasil dihapus.');
})->name('visitor.session.destroy');


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
    Route::resource('agenda', AgendaController::class);
    Route::post('/agenda/upload_lampiran', [AgendaController::class, 'upload_lampiran'])->name('agenda.upload_lampiran');
    Route::post('/agenda/update_lampiran', [AgendaController::class, 'update_lampiran'])->name('agenda.update_lampiran');
    Route::get('/agenda/hapus_lampiran/{id_lampiran}', [AgendaController::class, 'hapus_lampiran'])->name('agenda.hapus_lampiran');

    Route::get('/pengunjung', [PengunjungController::class, 'index'])->name('pengunjung.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
