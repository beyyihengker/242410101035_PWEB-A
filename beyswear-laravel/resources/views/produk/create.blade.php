@extends('layouts.app')

@section('content')

<section class="form-box">
    <div class="tabel-header">
        <h1>Tambah Produk</h1>
    </div>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="form-data">

            @csrf

            <div class="form-row">

                <div class="form-grup">
                    <input type="text" name="kode" value="{{ old('kode') }}" placeholder="Masukkan kode produk">
                </div>

                <div class="form-grup">
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama produk">
                </div>

                <div class="form-grup">
                    <select name="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="Kemeja">Kemeja</option>
                        <option value="Celana">Celana</option>
                        <option value="Dress">Dress</option>
                        <option value="Outer / Jaket">Outer / Jaket</option>
                        <option value="Aksesori">Aksesori</option>
                    </select>
                </div>

                <div class="form-grup">
                    <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Masukkan harga produk" >
                </div>

                <div class="form-grup">
                    <input type="file" name="foto">
                </div>

                <div class="form-action">
                    <button id="btnTambah" class="btn btn-primer">Simpan Produk</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-primer"> Kembali</a>
                </div>

            </div>
        </form>

</section>

@endsection