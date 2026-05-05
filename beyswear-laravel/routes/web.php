<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfilController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/tentang', [DashboardController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [DashboardController::class, 'kontak'])->name('kontak');
Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');