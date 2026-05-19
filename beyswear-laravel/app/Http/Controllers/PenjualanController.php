<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::query()
            ->orderBy('created_at', 'desc')
            ->get();

        $produkAll = Produk::with('varians')
            ->orderBy('nama')
            ->get();

        return view(
            'penjualan',
            compact('transaksi', 'produkAll')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id'   => 'required|exists:produks,id',
            'jumlah_beli' => 'required|integer|min:1',
            'pembayaran'  => 'required|in:Cash,QRIS',
            'ukuran'      => 'nullable|string',
            'warna'       => 'nullable|string',
        ], [
            'produk_id.required'   => 'Produk wajib dipilih.',
            'jumlah_beli.required' => 'Jumlah beli wajib diisi.',
            'jumlah_beli.min'      => 'Jumlah beli minimal 1.',
            'pembayaran.required'  => 'Metode pembayaran wajib dipilih.',
        ]);

        if (
            !$request->filled('ukuran') &&
            !$request->filled('warna')
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'warna' => 'Ukuran atau warna wajib dipilih.'
                ]);
        }

        $produk = Produk::findOrFail($request->produk_id);

        $varianQuery = $produk->varians();

        if ($request->filled('ukuran')) {
            $varianQuery->where('ukuran', $request->ukuran);
        } else {
            $varianQuery->whereNull('ukuran');
        }

        if ($request->filled('warna')) {
            $varianQuery->where('warna', $request->warna);
        } else {
            $varianQuery->whereNull('warna');
        }

        $varian = $varianQuery
        ->where('stok', '>', 0)
        ->first();

        if (!$varian) {

            return back()
                ->withInput()
                ->withErrors([
                    'warna' => 'Varian produk tidak ditemukan.'
                ]);
        }

        if ($varian->stok <= 0) {

            return back()
                ->withInput()
                ->withErrors([
                    'jumlah_beli' => 'Stok varian habis.'
                ]);
        }

        if ($request->jumlah_beli > $varian->stok) {

            return back()
                ->withInput()
                ->withErrors([
                    'jumlah_beli' =>
                    "Stok hanya tersisa {$varian->stok}"
                ]);
        }

        $nomorUrut = Transaksi::count() + 1;

        $kode = 'TRX-' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

        $total = $produk->harga * $request->jumlah_beli;

        DB::transaction(function () use (
            $request,
            $produk,
            $varian,
            $kode,
            $total
        ) {

            Transaksi::create([
                'kode_transaksi' => $kode,
                'produk'         => $produk->nama,
                'ukuran'         => $request->ukuran,
                'warna'          => $request->warna,
                'qty'            => $request->jumlah_beli,
                'tanggal'        => now(),
                'total_harga'    => $total,
                'pembayaran'     => $request->pembayaran,
            ]);

            $varian->decrement(
                'stok',
                $request->jumlah_beli
            );
        });

        return redirect()
            ->route('penjualan')
            ->with(
                'success',
                'Transaksi berhasil! Stok otomatis terupdate.'
            );
    }

    public function cancel(Transaksi $transaksi)
    {
        if ($transaksi->status === 'dibatalkan') {
            return back()->with('error', 'Transaksi sudah dibatalkan sebelumnya.');
        }

        DB::transaction(function () use ($transaksi) {
            $produk = Produk::query()->where('nama', '=', $transaksi->produk)->first();

            if ($produk) {
                $varianQuery = $produk->varians();

                if ($transaksi->ukuran) {
                    $varianQuery->where('ukuran', $transaksi->ukuran);
                } else {
                    $varianQuery->whereNull('ukuran');
                }

                if ($transaksi->warna) {
                    $varianQuery->where('warna', $transaksi->warna);
                } else {
                    $varianQuery->whereNull('warna');
                }

                $varian = $varianQuery->first();

                if ($varian) {
                    $varian->increment('stok', $transaksi->qty);
                }
            }

            $transaksi->update([
                'status' => 'dibatalkan'
            ]);
        });

        return back()->with('success', 'Transaksi berhasil dibatalkan dan stok dikembalikan.');
    }
}