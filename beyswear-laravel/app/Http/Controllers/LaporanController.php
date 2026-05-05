<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter bulan & tahun
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // Dummy data transaksi
        $transaksi = [
            ['kode'=>'TRX-001',
            'produk'=>'Nevadi Ki Basic Tee',
            'ukuran'=>'M',
            'warna'=>'Hitam',
            'qty'=>'1',
            'tanggal'=>'2026-04-10',
            'total'=>220000,
            'pembayaran'=>'QRIS'
            ],
            ['kode'=>'TRX-002',
            'produk'=>'Celana Chino',
            'ukuran'=>'L',
            'warna'=>'Krem',
            'qty'=>'1',
            'tanggal'=>'2026-04-11',
            'total'=>185000,
            'pembayaran'=>'Cash'
            ],
        ];

        // FILTER BERDASARKAN BULAN
        $filtered = array_filter($transaksi, function($t) use ($bulan, $tahun){
            return date('m', strtotime($t['tanggal'])) == $bulan &&
                   date('Y', strtotime($t['tanggal'])) == $tahun;
        });

        // ========================
        // HITUNG DATA LAPORAN
        // ========================

        $jumlahTransaksi = count($filtered);

        $totalOmzet = array_sum(array_column($filtered, 'total'));

        // omzet mingguan (dibagi 4 sederhana)
        $omzetMingguan = $jumlahTransaksi ? round($totalOmzet / 4) : 0;

        // hitung produk terlaris
        $produkCount = [];
        foreach($filtered as $t){
            if(!isset($produkCount[$t['produk']])){
                $produkCount[$t['produk']] = 0;
            }
            $produkCount[$t['produk']] += $t['qty'];
        }

        arsort($produkCount);

        $produkTerlaris = key($produkCount) ?? '-';
        $produkKurang = count($produkCount) ? array_key_last($produkCount) : '-';

        $laporan = [
            'mingguke'=>'1',
            'jumlahTransaksi' => $jumlahTransaksi,
            'omzetMingguan' => $omzetMingguan,
            'produkTerlaris' => $produkTerlaris,
            'produkKurang' => $produkKurang,
            'totalOmzet' => $totalOmzet
        ];

        return view('laporan', compact('laporan','bulan','tahun'));
    }
}