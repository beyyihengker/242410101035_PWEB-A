<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Pastikan nama class SAMA dengan nama file: PenjualanController
class PenjualanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            $transaksi = Transaksi::query()->orderBy('created_at', 'desc')->get();
        } else {
            $transaksi = Transaksi::query()
                ->where('user_id', '=', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('Transaksi.index', compact('transaksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required',
            'jumlah_beli' => 'required|integer|min:1',
            'pembayaran' => 'required', // Tambahkan ini agar Cash/QRIS masuk
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Simpan Transaksi
        Transaksi::create($data);

        // Ambil produk dan kurangi stok (Point Transaksi nyambung ke Produk)
        $produk = Produk::query()->where('id', '=', $request->produk_id)->first();

        if ($produk) {
            $produk->stok = $produk->stok - $request->jumlah_beli;
            $produk->save();
        }

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi Berhasil & Stok terupdate!');
    }
}