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
        'kategori' => 'Kemeja',
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG002',
        'nama' => 'Celana Chino',
        'kategori' => 'Celana',
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG003',
        'nama' => 'Midi Dress Floral',
        'kategori' => 'Dress',
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG004',
        'nama' => 'Fissol Raqueline Watch',
        'kategori' => 'Aksesori',
        'tersedia' => true
    ]);

    \App\Models\Produk::create([
        'kode' => 'BRG005',
        'nama' => 'Cardigan Rajut',
        'kategori' => 'Outer / Jaket',
        'tersedia' => true
    ]);

    }
}
