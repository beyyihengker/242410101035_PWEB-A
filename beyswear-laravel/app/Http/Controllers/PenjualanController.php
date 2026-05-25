<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaksi::with('details')
            ->when($request->filled('keyword'), function ($query) use ($request) {
                $keyword = $request->keyword;

                $query->where(function ($q) use ($keyword) {
                    $q->where('kode_transaksi', 'LIKE', "%{$keyword}%")
                        ->orWhere('produk', 'LIKE', "%{$keyword}%")
                        ->orWhereHas('details', function ($detail) use ($keyword) {
                            $detail->where('produk', 'LIKE', "%{$keyword}%")
                                ->orWhere('warna', 'LIKE', "%{$keyword}%")
                                ->orWhere('ukuran', 'LIKE', "%{$keyword}%");
                        });
                });
            })
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $kategori = $request->kategori;

                $query->where(function ($q) use ($kategori) {

                    $q->whereHas('details.produkData', function ($produk) use ($kategori) {
                        $produk->where('kategori', $kategori);
                    })

                    ->orWhereHas('details', function ($detail) use ($kategori) {
                        $detail->where('produk', 'LIKE', "%{$kategori}%");
                    })

                    ->orWhereIn('produk', function ($sub) use ($kategori) {
                        $sub->select('nama')
                            ->from('produks')
                            ->where('kategori', $kategori);
                    });
                });
            })
            ->when($request->filled('tanggal'), function ($query) use ($request) {
                $query->whereDate('tanggal', $request->tanggal);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $produkAll = Produk::with('varians')
            ->orderBy('nama')
            ->get();

        return view('penjualan', compact('transaksi', 'produkAll'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.produk_id' => 'required|exists:produks,id',
            'items.*.ukuran' => 'nullable|string',
            'items.*.warna' => 'nullable|string',
            'items.*.qty' => 'required|integer|min:1',
            'pembayaran' => 'required|in:Cash,QRIS',
        ]);

        DB::transaction(function () use ($request) {
            $kode = 'TRX-' . str_pad(Transaksi::count() + 1, 3, '0', STR_PAD_LEFT);

            $total = 0;
            $detailData = [];

            foreach ($request->items as $item) {
                $produk = Produk::findOrFail($item['produk_id']);

                $varianQuery = $produk->varians();

                empty($item['ukuran'])
                    ? $varianQuery->whereNull('ukuran')
                    : $varianQuery->where('ukuran', $item['ukuran']);

                empty($item['warna'])
                    ? $varianQuery->whereNull('warna')
                    : $varianQuery->where('warna', $item['warna']);

                $varian = $varianQuery->first();

                if (!$varian || $varian->stok < $item['qty']) {
                    throw new \Exception('Stok varian tidak cukup.');
                }

                $subtotal = $produk->harga * $item['qty'];
                $total += $subtotal;

                $detailData[] = [
                    'produk_id' => $produk->id,
                    'produk' => $produk->nama,
                    'ukuran' => $item['ukuran'] ?? null,
                    'warna' => $item['warna'] ?? null,
                    'qty' => $item['qty'],
                    'jumlah' => $item['qty'],
                    'harga' => $produk->harga,
                    'subtotal' => $subtotal,
                ];

                $varian->decrement('stok', $item['qty']);
            }

            $transaksi = Transaksi::create([
                'kode_transaksi' => $kode,
                'tanggal' => now(),
                'total_harga' => $total,
                'pembayaran' => $request->pembayaran,
                'status' => 'berhasil',
            ]);

            $transaksi->details()->createMany($detailData);
        });

        return redirect()
            ->route('penjualan')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    public function struk(Transaksi $transaksi)
    {
        $transaksi->load('details');

        return view('struk', compact('transaksi'));
    }

    public function cancel(Transaksi $transaksi)
    {
        if ($transaksi->status === 'dibatalkan') {
            return back()->with('error', 'Transaksi sudah dibatalkan.');
        }

        DB::transaction(function () use ($transaksi) {
            foreach ($transaksi->details as $detail) {
                $produk = Produk::query()
                    ->where('nama', '=', $detail->produk)
                    ->first();

                if (!$produk) continue;

                $varianQuery = $produk->varians();

                $detail->ukuran
                    ? $varianQuery->where('ukuran', $detail->ukuran)
                    : $varianQuery->whereNull('ukuran');

                $detail->warna
                    ? $varianQuery->where('warna', $detail->warna)
                    : $varianQuery->whereNull('warna');

                $varian = $varianQuery->first();

                if ($varian) {
                    $varian->increment('stok', $detail->qty);
                }
            }

            $transaksi->update([
                'status' => 'dibatalkan'
            ]);
        });

        return back()->with('success', 'Transaksi dibatalkan dan stok dikembalikan.');
    }
}