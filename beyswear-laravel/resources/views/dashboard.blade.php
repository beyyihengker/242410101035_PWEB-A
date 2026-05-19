@extends('layouts.app')

@section('title', 'Dashboard — BeysWear Fashion')

@section('content')
<div class="container-fluid">

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
                        <td>{{ $t->kode_transaksi }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $t->produk }}</td>
                        <td>{{ $t->ukuran ?? '-' }}</td>
                        <td>{{ $t->warna ?? '-' }}</td>
                        <td>{{ $t->qty }}</td>
                        <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $t->pembayaran }}</td>
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
                        <td>{{ $p['kategori'] ?? '-' }}</td>
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

<section class="form-box dashboard-section">
    <div class="section-heading">
        <div class="section-title-wrap">
            <div>
                <h3>Trend Fashion BeysWear</h3>
                <p>Produk yang sedang banyak diminati</p>
            </div>
        </div>
    </div>

    <div id="trendContainer">
        <div class="loading-box">Loading produk...</div>
    </div>
</section>

<section class="form-box dashboard-section">
    <div class="section-heading">
        <div class="section-title-wrap">
            <div>
                <h3>Aktivitas Dashboard POS</h3>
                <p>Statistik kunjungan dashboard</p>
            </div>
        </div>

        <form action="{{ route('reset.session') }}" method="POST">
            @csrf
            <button class="btn btn-primer reset-btn">
                Reset Hitungan
            </button>
        </form>
    </div>

    <div class="visit-grid">
        <div class="visit-card">
            <div class="visit-icon">👥</div>
            <div>
                <p>Total Kunjungan</p>
                <h2>{{ $visit }}</h2>
                <span>Jumlah total kunjungan dashboard</span>
            </div>
        </div>

        <div class="visit-card">
            <div class="visit-icon green">📅</div>
            <div>
                <p>Kunjungan Pertama</p>
                <h2>{{ \Carbon\Carbon::parse($first)->format('d M Y') }}</h2>
                <span>{{ \Carbon\Carbon::parse($first)->format('H:i:s') }}</span>
            </div>
        </div>

        <div class="visit-card">
            <div class="visit-icon purple">📅</div>
            <div>
                <p>Kunjungan Terakhir</p>
                <h2>{{ \Carbon\Carbon::parse($last)->format('d M Y') }}</h2>
                <span>{{ \Carbon\Carbon::parse($last)->format('H:i:s') }}</span>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    console.log("Dashboard BeysWear Berhasil Dimuat!");
</script>
@endpush

@endsection