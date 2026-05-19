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

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        <div class="form-row">

            <div class="form-grup">
                <input type="text" id="kode" placeholder="Kode Barang" readonly>
            </div>

            <div class="form-grup">
                <select id="produkSelect" name="produk_id" required>
                    <option value="">Pilih Produk</option>
                    @foreach($produkAll as $p)
                        <option value="{{ $p->id }}" {{ old('produk_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>
                <span id="stokInfo" style="font-size:.75rem;margin-top:4px;"></span>
            </div>

            <div class="form-grup">
                <select id="ukuranSelect" name="ukuran">
                    <option value="">Pilih Ukuran</option>
                </select>
            </div>

            <div class="form-grup">
                <select id="warnaSelect" name="warna">
                    <option value="">Pilih Warna</option>
                </select>
            </div>

            <div class="form-grup">
                <input type="number" id="qty" name="jumlah_beli"
                    placeholder="Qty" min="1"
                    value="{{ old('jumlah_beli') }}" required>

                @error('jumlah_beli')
                    <span style="font-size:.75rem;color:#c0392b;">{{ $message }}</span>
                @enderror

                <span id="qtyError" style="font-size:.75rem;color:#c0392b;"></span>
            </div>

            <div class="form-grup">
                <select id="pembayaran" name="pembayaran" required>
                    <option value="">Pilih Pembayaran</option>
                    <option value="Cash">Cash</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>

            <button type="submit" id="btnTransaksi" class="btn btn-primer">
                Tambah Transaksi
            </button>

        </div>
    </form>
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
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->produk }}</td>
                    <td>{{ $t->ukuran ?? '-' }}</td>
                    <td>{{ $t->warna ?? '-' }}</td>
                    <td>{{ $t->qty }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $t->pembayaran }}</td>
                    <td>
                        @if($t->status === 'dibatalkan')
                            <span class="badge" style="background:#fdecea;color:#c0392b;">Dibatalkan</span>
                        @else
                            <span class="badge" style="background:#eaf4ea;color:#1e8449;">Berhasil</span>
                        @endif
                    </td>
                    <td>
                        @if($t->status !== 'dibatalkan')
                            <form action="{{ route('penjualan.cancel', $t->id) }}" method="POST"
                                onsubmit="return confirm('Batalkan transaksi ini dan kembalikan stok?')">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn btn-primer" style="background:#c0392b;">
                                    Batalkan
                                </button>
                            </form>
                        @else
                            <button class="btn btn-sekunder" disabled>
                                Selesai
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@push('scripts')

<script>
    window.produkData = @json($produkAll);
</script>

@endpush

@endsection