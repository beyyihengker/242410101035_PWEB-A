<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $query = Transaksi::query()
            ->where('status', 'berhasil')
            ->where(DB::raw('MONTH(created_at)'), '=', $bulan)
            ->where(DB::raw('YEAR(created_at)'), '=', $tahun);

        $filtered = $query->get();

        $jumlahTransaksi = $filtered->count();

        $totalOmzet = $filtered->sum('total_harga');

        $laporanMingguan = Transaksi::query()
            ->where('status', 'berhasil')
            ->select(
                DB::raw('LEAST(CEIL(DAY(created_at) / 7), 4) as mingguke'),
                DB::raw('COUNT(*) as jumlahTransaksi'),
                DB::raw('SUM(total_harga) as omzetMingguan')
            )
            ->where(DB::raw('MONTH(created_at)'), '=', $bulan)
            ->where(DB::raw('YEAR(created_at)'), '=', $tahun)
            ->groupBy('mingguke')
            ->orderBy('mingguke')
            ->get();

        $produkTerlaris = $filtered
            ->groupBy('produk')
            ->map(fn($item) => $item->sum('qty'))
            ->sortDesc()
            ->keys()
            ->first() ?? '-';

        $produkKurang = $filtered
            ->groupBy('produk')
            ->map(fn($item) => $item->sum('qty'))
            ->sort()
            ->keys()
            ->first() ?? '-';

        $laporanBulanan = Transaksi::query()
            ->where('status', 'berhasil')
            ->select(
                DB::raw('MONTH(created_at) as bulan_num'),
                DB::raw('SUM(total_harga) as total_omzet'),
                DB::raw('COUNT(*) as jumlah_transaksi')
            )
            ->where(DB::raw('YEAR(created_at)'), '=', $tahun)
            ->groupBy('bulan_num')
            ->orderBy('bulan_num')
            ->get()
            ->keyBy('bulan_num');

        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        $tahunList = range(date('Y'), date('Y') - 3);

        return view('laporan', compact(
            'laporanMingguan',
            'jumlahTransaksi',
            'produkTerlaris',
            'produkKurang',
            'totalOmzet',
            'bulan',
            'tahun',
            'laporanBulanan',
            'namaBulan',
            'tahunList'
        ));
    }
}