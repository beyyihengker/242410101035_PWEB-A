<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['kode', 'nama', 'ukuran', 'warna', 'kategori', 'harga', 'stok', 'tersedia'];

    protected $casts = [
        'tersedia' => 'boolean',
        'harga' => 'decimal:2',
    ];

    public function scopeTersedia($query)
    {
        return $query->where('tersedia', true);
    }

    public function transaksis()
{
    return $this->belongsToMany(Transaksi::class, 'detail_transaksi');
}
}