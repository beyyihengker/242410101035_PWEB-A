<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'total_harga',
        'pembayaran'
    ];

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'detail_transaksi')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}