<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\ProdukVarian;
use App\Models\DetailTransaksi;
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
            'totalTerjual' => DetailTransaksi::query()->whereHas('transaksi', function ($q) {$q->where('status', 'berhasil');})->sum('qty'),
        ];

        $transaksi = Transaksi::with('details')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

            $produkTerlarisBaru = DetailTransaksi::query()
                ->select('produk', DB::raw('SUM(qty) as terjual'))
                ->whereHas('transaksi', function ($q) {
                    $q->where('status', 'berhasil');
                })
                ->groupBy('produk')
                ->get();

            $produkTerlarisLama = Transaksi::query()
                ->select('produk', DB::raw('SUM(qty) as terjual'))
                ->where('status', 'berhasil')
                ->whereNotNull('produk')
                ->groupBy('produk')
                ->get();

            $produkTerlaris = $produkTerlarisBaru
                ->concat($produkTerlarisLama)
                ->groupBy('produk')
                ->map(function ($items, $namaProduk) {

                    $produk = Produk::query()
                        ->where('nama', '=', $namaProduk)
                        ->first();

                    return [
                        'nama' => $namaProduk,
                        'kategori' => $produk ? $produk->kategori : '-',
                        'terjual' => $items->sum('terjual'),
                    ];
                })
                ->sortByDesc('terjual')
                ->take(2)
                ->values();

            $stokMenipisList = ProdukVarian::with('produk')
            ->where('stok', '<', 5)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', [
            'statistik'      => $statistik,
            'transaksi'      => $transaksi,
            'produkTerlaris' => $produkTerlaris,
            'stokMenipisList' => $stokMenipisList,
            'visit'          => session('visit_count'),
            'first'          => session('first_visit'),
            'last'           => session('last_visit'),
        ]);
    }
}