<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetailTransaksi;

class Transaksi extends Model
{
    protected $fillable = [
        'kode_transaksi',
        'tanggal',
        'total_harga',
        'pembayaran',
        'status',
    ];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}