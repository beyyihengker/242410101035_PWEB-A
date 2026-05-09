@extends('layouts.app')

@section('title', 'Penjualan — BeysWear Fashion')

@section('content')

<section class="form-box">
    <h3 class="seksi-label" id="lbl-form">Cari Data Transaksi</h3>
    <div class="form-row">

        <div class="form-grup">
            <input type="text" id="searchInput" placeholder="cth. Basic Tee…">
        </div>

        <div class="form-grup">
            <select id="cari-kategori">
            <option value="">Semua Kategori</option>
            <option>Kemeja</option>
            <option>Celana</option>
            <option>Dress</option>
            <option>Outer / Jaket</option>
            <option>Aksesori</option>
            </select>
        </div>

        <div class="form-grup">
            <input type="date" id="cari-tanggal">
        </div>

        <button class="btn btn-primer" type="button">Cari</button>
    </div>
</section>

<section class="form-box">
    <h3 class="seksi-label">Tambah Transaksi</h3>
    <div class="form-row">

        <div class="form-grup">
            <input type="text" id="kode" placeholder="Kode Barang">
        </div>

        <div class="form-grup">
            <select id="produkSelect">

                <option value="">Pilih Produk</option>

                @foreach($produk as $p)

                    <option value="{{ $p->id }}">
                        {{ $p->nama }}
                    </option>

                @endforeach

            </select>
        </div>

        <div class="form-grup">
            <select id="warnaSelect">
                <option value="">Pilih Warna</option>
            </select>
        </div>

        <div class="form-grup">
            <select id="ukuranSelect">
                <option value="">Pilih Ukuran</option>
            </select>
        </div>

        <div class="form-grup">
            <input type="number" id="qty" placeholder="Qty">
        </div>

        <div class="form-grup">
            <select id="pembayaran">
                <option value="">Pilih Pembayaran</option>
                <option>Cash</option>
                <option>QRIS</option>
            </select>
        </div>

        <div class="form-grup">
            <input type="date" id="tanggalJual">
        </div>

        <button id="btnTransaksi" class="btn btn-primer">Tambah Transaksi</button>

    </div>
</section>

<section class="form-box">
    <div class="tabel-header">
        <h3>Data Seluruh Transaksi</h3>
    </div>

    <div class="tabel-scroll">

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Produk</th>
                    <th>Ukuran</th>
                    <th>Warna</th>
                    <th>Qty</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $t['kode'] }}</td>
                    <td>{{ $t['produk'] }}</td>
                    <td>{{ $t['ukuran'] }}</td>
                    <td>{{ $t['warna'] }}</td>
                    <td>{{ $t['qty'] }}</td>
                    <td>{{ $t['tanggal'] }}</td>
                    <td>Rp {{ number_format($t['total']) }}</td>
                    <td>{{ $t['pembayaran'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@push('scripts')

<script>
    window.produkData = @json($produk);
</script>

<script src="{{ asset('js/script.js') }}"></script>

@endpush

@endsection