<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukVarian;

class ProdukVarianController extends Controller
{
    public function store(Request $request)
    {
        $produkId = $request->produk_id;

        $request->merge([
            'ukuran' => $request->ukuran ?: null,
            'warna'  => $request->warna ?: null,
        ]);

        if (!$request->ukuran && !$request->warna) {
            return redirect()
                ->route('produk.show', $produkId)
                ->withInput()
                ->withErrors([
                    'varian' => 'Ukuran atau warna minimal salah satu harus diisi.'
                ]);
        }

        $validated = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'ukuran' => 'nullable|string',
            'warna' => 'nullable|string',
            'stok' => 'required|integer|min:0',
        ]);

        $existing = ProdukVarian::where('produk_id', $validated['produk_id'])
            ->where(function ($query) use ($validated) {
                $validated['ukuran'] === null
                    ? $query->whereNull('ukuran')
                    : $query->where('ukuran', $validated['ukuran']);
            })
            ->where(function ($query) use ($validated) {
                $validated['warna'] === null
                    ? $query->whereNull('warna')
                    : $query->where('warna', $validated['warna']);
            })
            ->first();

        if ($existing) {
            $existing->increment('stok', $validated['stok']);

            return redirect()
                ->route('produk.show', $validated['produk_id'])
                ->with('success', 'Stok varian berhasil ditambahkan.');
        }

        ProdukVarian::create($validated);

        return redirect()
            ->route('produk.show', $validated['produk_id'])
            ->with('success', 'Varian berhasil ditambahkan');
    }
}
