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

        $query = Transaksi::with('produk')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);

        $filtered = $query->get();

        $jumlahTransaksi = $filtered->count();
        $totalOmzet      = $filtered->sum('total');
        $omzetMingguan   = $jumlahTransaksi ? round($totalOmzet / 4) : 0;

        // Produk terlaris
        $produkCount = $filtered->groupBy('produk_id')
            ->map(fn($g) => $g->sum('jumlah_beli'))
            ->sortDesc();

        $produkTerlaris = $produkCount->isNotEmpty()
            ? Transaksi::with('produk')->find($produkCount->keys()->first())?->produk?->nama ?? '-'
            : '-';

        $produkKurang = $produkCount->count() > 1
            ? Transaksi::with('produk')->find($produkCount->keys()->last())?->produk?->nama ?? '-'
            : '-';

        // Ringkasan per bulan (untuk grafik/tabel bulanan)
        $laporanBulanan = Transaksi::select(
                DB::raw('MONTH(created_at) as bulan_num'),
                DB::raw('SUM(total) as total_omzet'),
                DB::raw('COUNT(*) as jumlah_transaksi')
            )
            ->whereYear('created_at', $tahun)
            ->groupBy('bulan_num')
            ->orderBy('bulan_num')
            ->get()
            ->keyBy('bulan_num');

        $laporan = [
            'jumlahTransaksi' => $jumlahTransaksi,
            'omzetMingguan'   => $omzetMingguan,
            'produkTerlaris'  => $produkTerlaris,
            'produkKurang'    => $produkKurang,
            'totalOmzet'      => $totalOmzet,
        ];

        $namaBulan = [
            1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'Mei',6=>'Jun',
            7=>'Jul',8=>'Agu',9=>'Sep',10=>'Okt',11=>'Nov',12=>'Des'
        ];

        $tahunList = range(date('Y'), date('Y') - 3);

        return view('laporan', compact(
            'laporan', 'bulan', 'tahun',
            'laporanBulanan', 'namaBulan', 'tahunList'
        ));
    }
}