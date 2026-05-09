@extends('layouts.app')

@section('title', 'Edit Produk — BeysWear Fashion')

@section('content')

<section class="form-box">

    <div class="tabel-header">
        <h1>Edit Produk</h1>
    </div>

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="form-data">

        @csrf
        @method('PUT')

        <div class="form-row">

            <div class="form-grup">
                <input type="text" name="kode" value="{{ old('kode', $produk->kode) }}" placeholder="Masukkan kode produk">
            </div>

            <div class="form-grup">
                <input type="text" name="nama" value="{{ old('nama', $produk->nama) }}" placeholder="Masukkan nama produk">
            </div>

            <div class="form-grup">
                <select name="kategori">
                    <option value="">Pilih Kategori</option>
                    <option value="Kemeja" {{ old('kategori', $produk->kategori) == 'Kemeja' ? 'selected' : '' }}>Kemeja</option>
                    <option value="Celana" {{ old('kategori', $produk->kategori) == 'Celana' ? 'selected' : '' }}>Celana</option>
                    <option value="Dress" {{ old('kategori', $produk->kategori) == 'Dress' ? 'selected' : '' }}>Dress</option>
                    <option value="Outer / Jaket" {{ old('kategori', $produk->kategori) == 'Outer / Jaket' ? 'selected' : '' }}>Outer / Jaket</option>
                    <option value="Aksesori" {{ old('kategori', $produk->kategori) == 'Aksesori' ? 'selected' : '' }}>Aksesori</option>
                </select>

            </div>

            <div class="form-grup">
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" placeholder="Masukkan harga produk">
            </div>

            <div class="form-grup">
                <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" placeholder="Masukkan stok produk">
            </div>

            <div class="form-grup">
                <input type="file" name="foto">
            </div>

            <div class="aksi-btn">
                <button type="submit" class="btn btn-primer">Update Produk</button>
                <a href="{{ route('produk.index') }}" class="btn btn-primer">Kembali</a>
            </div>

        </div>

    </form>

</section>

@endsection