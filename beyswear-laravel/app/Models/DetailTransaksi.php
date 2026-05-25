<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'produk',
        'ukuran',
        'warna',
        'qty',
        'jumlah',
        'harga',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function produkData()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}