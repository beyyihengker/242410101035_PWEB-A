<?php

namespace App\Http\Controllers;

class PenjualanController extends Controller
{
    public function index()
    {
        $transaksi = [
            ['kode'=>'TRX-001',
            'produk'=>'Nevadi Ki Basic Tee',
            'ukuran'=>'M',
            'warna'=>'Hitam',
            'qty'=>'1',
            'tanggal'=>'2026-04-10',
            'total'=>220000,
            'pembayaran'=>'QRIS'
            ],
            ['kode'=>'TRX-002',
            'produk'=>'Celana Chino',
            'ukuran'=>'L',
            'warna'=>'Krem',
            'qty'=>'1',
            'tanggal'=>'2026-04-11',
            'total'=>185000,
            'pembayaran'=>'Cash'
            ],
        ];

        return view('penjualan', compact('transaksi'));
    }
}