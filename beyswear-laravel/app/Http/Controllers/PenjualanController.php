<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('produk')
            ->orderBy('created_at', 'desc')
            ->get();

        $produkAll = Produk::select('id', 'nama', 'ukuran', 'warna', 'stok', 'harga')
            ->orderBy('nama')
            ->get();

        return view('Transaksi.index', compact('transaksi', 'produkAll'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id'  => 'required|exists:produks,id',
            'jumlah_beli'=> 'required|integer|min:1',
            'pembayaran' => 'required|in:Cash,QRIS',
            'ukuran'     => 'nullable|string',
            'warna'      => 'nullable|string',
        ], [
            'produk_id.required'   => 'Produk wajib dipilih.',
            'jumlah_beli.required' => 'Jumlah beli wajib diisi.',
            'jumlah_beli.min'      => 'Jumlah beli minimal 1.',
            'pembayaran.required'  => 'Metode pembayaran wajib dipilih.',
        ]);

        $produk = Produk::findOrFail($request->produk_id);

        // ===== VALIDASI STOK =====
        if ($produk->stok <= 0) {
            return back()
                ->withInput()
                ->withErrors(['jumlah_beli' => "Stok {$produk->nama} sudah habis!"]);
        }

        if ($request->jumlah_beli > $produk->stok) {
            return back()
                ->withInput()
                ->withErrors(['jumlah_beli' => "Stok {$produk->nama} hanya tersisa {$produk->stok} item."]);
        }
        // =========================

        DB::transaction(function () use ($request, $produk) {
            Transaksi::create([
                'user_id'    => Auth::id(),
                'produk_id'  => $produk->id,
                'jumlah_beli'=> $request->jumlah_beli,
                'pembayaran' => $request->pembayaran,
                'ukuran'     => $request->ukuran,
                'warna'      => $request->warna,
                'total'      => $produk->harga * $request->jumlah_beli,
            ]);

            // Kurangi stok secara aman (hindari race condition)
            $produk->decrement('stok', $request->jumlah_beli);
        });

        return redirect()->route('penjualan')
            ->with('success', 'Transaksi berhasil! Stok otomatis terupdate.');
    }
}