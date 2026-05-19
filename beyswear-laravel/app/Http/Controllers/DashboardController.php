<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\ProdukVarian;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('welcome_flash')) {
            session()->flash('success', 'Selamat datang kembali!');
            session(['welcome_flash' => true]);
        }

        $count = session('visit_count', 0);

        session([
            'visit_count' => $count + 1,
            'last_visit' => now(),
        ]);

        if (!session()->has('first_visit')) {
            session([
                'first_visit' => now(),
            ]);
        }

        $statistik = [
            'totalItem' => Produk::query()->count(),
            'totalPenjualan' => Transaksi::query()->where('status', 'berhasil')->sum('total_harga'),
            'stokMenipis' => ProdukVarian::query()->where('stok', '<', 5)->count(),
            'totalTerjual' => Transaksi::query()->where('status', 'berhasil')->sum('qty'),
        ];

        $transaksi = Transaksi::query()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $produkTerlaris = Transaksi::query()
            ->select('produk', DB::raw('SUM(qty) as terjual'))
            ->groupBy('produk')
            ->orderByDesc('terjual')
            ->take(2)
            ->get()
            ->map(function ($t) {
                $produk = Produk::query()->where('nama', '=', $t->produk)->first();

                return [
                    'nama' => $t->produk,
                    'kategori' => $produk ? $produk->kategori : '-',
                    'terjual' => $t->terjual,
                ];
            });

        return view('dashboard', [
            'statistik'      => $statistik,
            'transaksi'      => $transaksi,
            'produkTerlaris' => $produkTerlaris,
            'visit'          => session('visit_count'),
            'first'          => session('first_visit'),
            'last'           => session('last_visit'),
        ]);
    }
}