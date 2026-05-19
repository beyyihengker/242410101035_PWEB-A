<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('varians')->orderBy('kode', 'asc')->paginate(10);

        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:produks,kode',
            'nama' => 'required|min:3',
            'kategori' => 'required|in:Kemeja,Celana,Dress,Outer / Jaket,Aksesori',
            'harga' => 'required|numeric|min:1',
            'foto' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            $path = $request->file('foto')
                ->store('produk', 'public');

            $validated['foto'] = $path;
        }

        Produk::create($validated);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        $produk->load('varians');

        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:produks,kode,' . $produk->id,
            'nama' => 'required|min:3',
            'kategori' => 'required|in:Kemeja,Celana,Dress,Outer / Jaket,Aksesori',
            'harga' => 'required|numeric|min:1',
            'foto' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            $path = $request->file('foto')
                ->store('produk', 'public');

            $validated['foto'] = $path;
        }

        $produk->update($validated);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = \App\Models\Produk::findOrFail($id);

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk  berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $produk = Produk::query()
            ->where('nama', 'LIKE', "%{$keyword}%")
            ->orWhere('kategori', 'LIKE', "%{$keyword}%")
            ->get();

        return response()->json($produk);
    }
}