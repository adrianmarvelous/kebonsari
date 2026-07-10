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

// Proxy Google Drive video agar bisa di-stream via HTML5 video player
Route::get('/video-proxy/{fileId}', function ($fileId) {
    $downloadUrl = 'https://drive.usercontent.google.com/download?id=' . urlencode($fileId) . '&export=download';

    // Set timeout lebih lama untuk video besar
    set_time_limit(300);

    return response()->stream(function () use ($downloadUrl) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $downloadUrl,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 300,
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_WRITEFUNCTION => function ($curl, $data) {
                echo $data;
                if (ob_get_level() > 0) ob_flush();
                flush();
                return strlen($data);
            },
        ]);
        curl_exec($ch);
        curl_close($ch);
    }, 200, [
        'Content-Type' => 'video/mp4',
        'Content-Disposition' => 'inline',
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->name('video.proxy');

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
        $totalUsers = \App\Models\User::count();
        $totalLayanan = \App\Models\Layanan::count();
        $totalAgenda = \App\Models\Agenda::count();
        $totalPengunjung = \App\Models\Visitor::count();

        $latestVisitors = \App\Models\Visitor::with('layanan')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $latestAgendas = \App\Models\Agenda::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ── Chart: Pengunjung per bulan (6 bulan terakhir) ──
        $bulanLabels = [];
        $bulanData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $bulanLabels[] = $date->isoFormat('MMM Y');
            $bulanData[] = \App\Models\Visitor::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
        }

        // ── Chart: Layanan per kategori ──
        $kategoriLabels = \App\Models\Layanan::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');
        $kategoriLabelArr = $kategoriLabels->keys()->toArray();
        $kategoriDataArr = $kategoriLabels->values()->toArray();

        // ── Chart: Pengunjung per layanan (top 5) ──
        $layananPopuler = \App\Models\Visitor::selectRaw('id_layanan, COUNT(*) as total')
            ->groupBy('id_layanan')
            ->orderByDesc('total')
            ->take(5)
            ->get();
        $layananLabelArr = $layananPopuler->map(function ($v) {
            return $v->layanan->nama_layanan ?? 'Unknown';
        })->toArray();
        $layananDataArr = $layananPopuler->pluck('total')->toArray();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalLayanan', 'totalAgenda', 'totalPengunjung',
            'latestVisitors', 'latestAgendas',
            'bulanLabels', 'bulanData',
            'kategoriLabelArr', 'kategoriDataArr',
            'layananLabelArr', 'layananDataArr'
        ));
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
    Route::get('/pengunjung/export_excel/{bulan}/{tahun}', [PengunjungController::class, 'export_excel'])->name('pengunjung.export_excel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
