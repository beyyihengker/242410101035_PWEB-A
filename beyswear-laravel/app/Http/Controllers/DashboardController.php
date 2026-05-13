<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('welcome_flash')) {
            session()->flash('success', 'Selamat datang kembali!');
            session(['welcome_flash' => true]);
        }

        $statistik = [
            'totalItem'      => Produk::query()->count(),
            'totalPenjualan' => Transaksi::query()->sum('total_harga'), // Pastikan kolomnya 'total_harga' sesuai migration
            'stokMenipis'    => Produk::query()->where('stok', '<', 5)->count(),
            'totalTerjual'   => Transaksi::query()->sum('jumlah_beli'),
        ];

        $transaksi = Transaksi::query()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $produkTerlaris = Transaksi::query()
            ->select('produk_id', DB::raw('SUM(jumlah_beli) as terjual'))
            ->groupBy('produk_id')
            ->orderByDesc('terjual')
            ->take(2)
            ->get()
            ->map(fn($t) => [
                'nama'     => $t->produk->nama ?? '-',
                'kategori' => $t->produk->kategori ?? '-',
                'terjual'  => $t->terjual,
            ]);

        return view('dashboard', compact('statistik', 'transaksi', 'produkTerlaris'));
    }
}