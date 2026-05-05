<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('welcome_flash')) {
            session()->flash('success', 'Selamat datang kembali!');
            session(['welcome_flash' => true]);
        }

        $statistik = [
            'totalItem' => 25,
            'totalPenjualan' => 1500000,
            'stokMenipis' => 3,
            'totalTerjual' => 40
        ];

        $transaksi = [
            [
                'kode' => 'TRX-001',
                'tanggal' => '2026-04-10',
                'produk' => 'Nevadi Ki Basic Tee',
                'ukuran' => 'M',
                'warna' => 'Hitam',
                'qty' => 2,
                'total' => 220000,
                'pembayaran' => 'QRIS'
            ],
            [
                'kode' => 'TRX-002',
                'tanggal' => '2026-04-11',
                'produk' => 'Celana Chino',
                'ukuran' => 'L',
                'warna' => 'Krem',
                'qty' => 1,
                'total' => 185000,
                'pembayaran' => 'Cash'
            ]
        ];

        $produkTerlaris = [
            ['nama'=>'Basic Tee','kategori'=>'Kemeja','terjual'=>20],
            ['nama'=>'Celana Chino','kategori'=>'Celana','terjual'=>15],
        ];

        return view('dashboard', compact('statistik','transaksi','produkTerlaris'));
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function kontak()
    {
        return view('kontak');
    }
}