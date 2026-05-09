<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukVarian;

class ProdukVarianController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'ukuran' => 'required',
            'warna' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        ProdukVarian::create($validated);

        return back()->with('success', 'Varian berhasil ditambahkan');
    }
}
