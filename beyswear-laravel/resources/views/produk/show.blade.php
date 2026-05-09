@extends('layouts.app')

@section('title', 'Detail Produk — BeysWear Fashion')

@section('content')

<section class="form-box">

    <div class="tabel-header">
        <h3>Detail Produk</h3>
    </div>

    <div class="detail-container">
        <div class="detail-kiri">

            <div class="detail-item">
                <label>Kode Produk</label>
                <input type="text" value="{{ $produk->kode }}" readonly>
            </div>

            <div class="detail-item">
                <label>Nama Produk</label>
                <input type="text" value="{{ $produk->nama }}" readonly>
            </div>

            <div class="detail-item">
                <label>Kategori</label>
                <input type="text" value="{{ $produk->kategori }}" readonly>
            </div>

            <div class="detail-item">
                <label>Harga Produk</label>
                <input type="text" value="Rp {{ number_format($produk->harga, 0, ',', '.') }}"readonly>
            </div>

            <div class="detail-item">
                <label>Total Stok</label>
                <input type="text" value="{{ $produk->varians->sum('stok') }} pcs" readonly>
            </div>

            <div class="detail-item">
                <label>Total Varian</label>
                <input type="text" value="{{ $produk->varians->count() }} Varian" readonly>
            </div>

            <div class="detail-item">
                <label>Ukuran Tersedia</label>
                <textarea rows="3" readonly>{{ $produk->varians->pluck('ukuran')->unique()->implode(', ') }}</textarea>
            </div>

            <div class="detail-item">
                <label>Warna Tersedia</label>
                <textarea rows="3" readonly>{{ $produk->varians->pluck('warna')->unique()->implode(', ') }}</textarea>
            </div>

        </div>

        <div class="detail-kanan">

            @if($produk->foto)

                <img src="{{ asset('storage/' . $produk->foto) }}" class="detail-foto">

            @else

                <div class="foto-kosong">
                    Tidak ada foto
                </div>

            @endif

            <a href="{{ route('produk.index') }}" class="btn btn-primer">Kembali</a>

        </div>

    </div>

    <div class="form-varian">

        <div class="tabel-header">
            <h3>Tambah Varian Produk</h3>
        </div>

        <form action="{{ route('varian.store') }}"method="POST">

            @csrf

            <input type="hidden" name="produk_id" value="{{ $produk->id }}">

            <div class="form-row">

                <div class="form-grup">
                    <select name="ukuran" id="cari-ukuran">
                        <option value="">Ukuran</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>


                <div class="form-grup">
                    <input type="text" name="warna" placeholder="Masukkan warna">
                </div>

                <div class="form-grup">
                    <input type="number" name="stok" placeholder="Masukkan stok">
                </div>

                <div class="form-action">
                    <button type="submit" class="btn btn-primer">Tambah Varian</button>

                </div>

            </div>

        </form>

    </div>

</section>

@endsection