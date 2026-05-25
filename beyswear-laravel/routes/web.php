<?php

use App\Models\Produk;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukVarianController;
use App\Http\Controllers\PreferensiController;
use Illuminate\Support\Facades\Route;

// 1. Landing Page (Bisa diakses siapa saja)
Route::get('/', function () {

    $produk = Produk::with('varians')
    ->where('tersedia', true)
    ->orderBy('created_at', 'desc')
    ->take(12)
    ->get();

    return view('welcome', ['produk' => $produk]);
});

// 2. Semua rute di bawah ini HARUS LOGIN dulu
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/reset-session', function () {session()->forget(['visit_count','first_visit','last_visit']);return back();})->name('reset.session');

    // Rute Profil (Nama rute: 'profil' agar tidak error di navbar)
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::patch('/profil', [ProfilController::class, 'update'])->name('profile.update');
    Route::patch('/profil/password', [ProfilController::class, 'updatePassword'])->name('profile.password');
    Route::post('/preferensi/save', [PreferensiController::class, 'save'])->name('preferensi.save');
    Route::get('/preferensi/get',[PreferensiController::class, 'getPreference'])->name('preferensi.get');
    Route::post('/varian',[ProdukVarianController::class, 'store'])->name('varian.store');

    // AKSES BERSAMA (Admin & Kasir)
    Route::middleware('role:admin,kasir')->group(function () {
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
        Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
        Route::get('/penjualan/{transaksi}/struk', [PenjualanController::class, 'struk'])->name('penjualan.struk');
        Route::patch('/penjualan/{transaksi}/cancel', [PenjualanController::class, 'cancel'])->name('penjualan.cancel');
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/search-produk', [ProdukController::class, 'search']);
        Route::get('/produk-trash', [ProdukController::class, 'trash'])->name('produk.trash');
        Route::patch('/produk/{id}/restore', [ProdukController::class, 'restore'])->name('produk.restore');
    });

    // KHUSUS ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::middleware('role:admin,kasir')->group(function () {
        Route::get('/produk/{produk}', [ProdukController::class, 'show'])->name('produk.show');
    });
});

require __DIR__.'/auth.php';