@extends('layouts.app')

@section('title', 'Dashboard — BeysWear Fashion')

@section('content')

<section class="hero-section">
    <div class="hero-overlay">
        <div class="hero-content">
            <h2>Selamat Datang di BeysWear</h2>
        </div>
    </div>
</section>

    <div class="statistik-grid">
        <x-stat-card judul="Total Item" :nilai="$statistik['totalItem']" />

        <x-stat-card
            judul="Total Penjualan"
            nilai="Rp {{ number_format($statistik['totalPenjualan']) }}"
            warna="#3C507D"
        />

        <x-stat-card
            judul="Stok Menipis"
            :nilai="$statistik['stokMenipis']"
            warna="#c0392b"
        />

        <x-stat-card judul="Total Terjual" :nilai="$statistik['totalTerjual']" />
    </div>

    <section class="tabel-box">
        <div class="tabel-header">
            <h3>Daftar Penjualan Terbaru</h3>
            <span class="chip">5 transaksi terakhir</span>
        </div>

        <div class="tabel-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Warna</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $t)
                    <tr>
                        <td>{{ $t['kode'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($t['tanggal'])->format('d/m/Y') }}</td>
                        <td>{{ $t['produk'] }}</td>
                        <td>{{ $t['ukuran'] }}</td>
                        <td>{{ $t['warna'] }}</td>
                        <td>{{ $t['qty'] }}</td>
                        <td>Rp {{ number_format($t['total']) }}</td>
                        <td>{{ $t['pembayaran'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">Belum ada data transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="tabel-box">
        <div class="tabel-header">
            <h3>Produk Terlaris</h3>
            <span class="chip">Top 2 produk</span>
        </div>

        <div class="tabel-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Total Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produkTerlaris as $p)
                    <tr>
                        <td>{{ $p['nama'] }}</td>
                        <td>{{ $p['kategori'] }}</td>
                        <td>{{ $p['terjual'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align: center;">Data produk terlaris belum tersedia.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

@push('scripts')
<script>
    console.log("Dashboard BeysWear Berhasil Dimuat!");
</script>
@endpush

@endsection