<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;

// Halaman utama (beranda)
Route::get('/', function() { 
    return view('welcome'); 
});

// Halaman laporan untuk masyarakat
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');

// Admin login & dashboard
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// Admin route dengan middleware auth untuk memastikan hanya admin yang dapat mengaksesnya
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Route untuk logout admin
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Laporan Masuk (admin) - Menampilkan daftar laporan yang masuk
    Route::get('/laporan/masuk', [LaporanController::class, 'masuk'])->name('laporan.masuk');

    // Detail Laporan (admin) - Melihat laporan berdasarkan ID
    Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');

    // Proses laporan (algoritma Dijkstra untuk menentukan pos damkar terdekat)
    Route::post('/laporan/{laporan}/proses', [LaporanController::class, 'prosesLaporan'])->name('laporan.proses');

    // Laporan Diterima (admin)
    Route::get('/laporan/diterima', [LaporanController::class, 'diterima'])->name('laporan.diterima');

    // Proses untuk menerima laporan dan mengubah status menjadi 'diterima'
    Route::patch('/laporan/{laporan}/terima', [LaporanController::class, 'terima'])->name('laporan.terima');

    // Menghapus laporan (admin) - Pastikan fungsi hapus ada di controller
    Route::delete('/laporan/{laporan}/hapus', [LaporanController::class, 'hapus'])->name('laporan.hapus');

    // Admin lihat laporan diterima
    Route::get('/admin/laporan/diterima', [AdminController::class, 'laporanDiterima'])->name('admin.laporan.diterima');
});