@extends('layouts.app')

@section('title', 'Produk — BeysWear Fashion')

@section('content')

<section class="form-box">
    <h3 class="seksi-label" id="lbl-form">Cari Data Produk</h3>
    <div class="form-row">

        <div class="form-grup">
            <input type="text" id="kodeProduk" placeholder="cth. BRG001">
        </div>

        <div class="form-grup">
            <input type="text" id="namaProduk" placeholder="cth. Nevadi Ki">
        </div>

        <div class="form-grup">
            <select id="cari-ukuran">
            <option value="">Ukuran</option>
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
            </select>
        </div>

        <div class="form-grup">
            <select id="cari-kategori">
            <option value="">Kategori</option>
                <option>Kemeja</option>
                <option>Celana</option>
                <option>Dress</option>
                <option>Outer / Jaket</option>
                <option>Aksesori</option>
            </select>
        </div>

        <button class="btn btn-primer" type="button">Cari</button>
    </div>
</section>

<section class="form-box">
    <h3 class="seksi-label">Tambah Produk</h3>
    <div class="form-row">

        <div class="form-grup">
            <input type="text" id="kode" placeholder="Kode Barang">
        </div>

        <div class="form-grup">
            <input type="text" placeholder="Nama Produk">
        </div>

        <div class="form-grup">
            <select id="ukuran">
                <option value="">Ukuran</option>
                <option></option>
                <option></option>
            </select>
        </div>

        <div class="form-grup">
            <input type="text" placeholder="Warna Produk">
        </div>

        <div class="form-grup">
            <input type="number" id="qty" placeholder="Qty">
        </div>

        <div class="form-grup">
            <input type="date" id="tanggalJual">
        </div>

        <button id="btnTransaksi" class="btn btn-primer">Tambah Transaksi</button>

    </div>
</section>

<section class="form-box">
    <div class="tabel-header">
        <h3>Data Seluruh Produk</h3>
    </div>

    <div class="tabel-scroll">
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Harga</th>
                </tr>
            </thead>

            <tbody>
                @foreach($produk as $p)
                <tr>
                    <td>{{ $p['kode'] }}</td>
                    <td>{{ $p['nama'] }}</td>
                    <td>{{ $p['ukuran'] }}</td>
                    <td>{{ $p['warna'] }}</td>
                    <td>{{ $p['kategori'] }}</td>
                    <td>{{ $p['stok'] }}</td>
                    <td>Rp {{ number_format($p['harga']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection