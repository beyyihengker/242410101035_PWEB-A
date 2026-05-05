<?php

namespace App\Http\Controllers;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = [
            ['kode'=>'BRG001',
            'nama'=>'Nevadi Ki Basic Tee',
            'ukuran'=>'L',
            'warna'=>'Hitam',
            'kategori'=>'Kemeja',
            'stok'=>'10',
            'harga'=>'220000'
            ]
        ];

        return view('produk', compact('produk'));
    }
}