<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    \App\Models\Produk::create([
        'kode' => 'BRG001',
        'nama' => 'Nevadi Ki Basic Tee',
        'ukuran' => 'M',
        'warna' => 'Hitam',
        'kategori' => 'Kemeja',
        'harga' => 220000,
        'stok' => 10,
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG002',
        'nama' => 'Celana Chino',
        'ukuran' => 'L',
        'warna' => 'Krem',
        'kategori' => 'Celana',
        'harga' => 185000,
        'stok' => 15,
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG003',
        'nama' => 'Midi Dress Floral',
        'ukuran' => 'M',
        'warna' => 'Putih',
        'kategori' => 'Dress',
        'harga' => 200000,
        'stok' => 20,
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG004',
        'nama' => 'Nevadi Ki Basic Tee',
        'ukuran' => 'M',
        'warna' => 'Putih',
        'kategori' => 'Kemeja',
        'harga' => 220000,
        'stok' => 5,
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG005',
        'nama' => 'Celana Chino',
        'ukuran' => 'L',
        'warna' => 'Hitam',
        'kategori' => 'Celana',
        'harga' => 185000,
        'stok' => 10,
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG006',
        'nama' => 'Midi Dress Floral',
        'ukuran' => 'L',
        'warna' => 'Kuning',
        'kategori' => 'Dress',
        'harga' => 200000,
        'stok' => 8,
        'tersedia' => true
    ]);

    }
}
