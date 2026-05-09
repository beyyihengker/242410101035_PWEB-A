<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukVarian;

class ProdukVarianSeeder extends Seeder
{
    public function run(): void
    {
        ProdukVarian::create([
            'produk_id' => 1,
            'ukuran' => 'M',
            'warna' => 'Hitam',
            'stok' => 10,
        ]);

        ProdukVarian::create([
            'produk_id' => 1,
            'ukuran' => 'L',
            'warna' => 'Hitam',
            'stok' => 5,
        ]);

        ProdukVarian::create([
            'produk_id' => 1,
            'ukuran' => 'M',
            'warna' => 'Putih',
            'stok' => 8,
        ]);
    }
}