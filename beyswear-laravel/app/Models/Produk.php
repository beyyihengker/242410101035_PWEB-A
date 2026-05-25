<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProdukVarian;

class Produk extends Model
{
    use SoftDeletes;

    protected $table = 'produks';

    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'harga',
        'stok',
        'foto',
        'tersedia'
    ];

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
        return $this->belongsToMany(
            Transaksi::class,
            'detail_transaksi'
        );
    }

    public function varians()
    {
        return $this->hasMany(ProdukVarian::class);
    }
}