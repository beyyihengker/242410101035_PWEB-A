<?php

use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// 1. Landing Page (Bisa diakses siapa saja)
Route::get('/', function () {
    return view('welcome');
});

// 2. Semua rute di bawah ini HARUS LOGIN dulu
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Profil (Nama rute: 'profil' agar tidak error di navbar)
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::patch('/profil', [ProfilController::class, 'update'])->name('profile.update');

    // AKSES BERSAMA (Admin & Kasir)
    Route::middleware('role:admin,kasir')->group(function () {
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
        Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store'); // Sambungkan ke Produk
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
    });

    // KHUSUS ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::resource('produk', ProdukController::class)->except(['index', 'show']);
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

require __DIR__.'/auth.php';