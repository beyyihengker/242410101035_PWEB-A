@extends('layouts.app')

@section('title', 'Laporan — BeysWear Fashion')

@section('content')

<section class="form-box">
    <h3 class="seksi-label">Laporan Bulanan</h3>

    <form method="GET" class="form-row">

        <div class="form-grup">
            <select name="bulan" class="form-control">
                @for($i=1;$i<=12;$i++)
                    <option value="{{ sprintf('%02d',$i) }}"
                        {{ $bulan == sprintf('%02d',$i) ? 'selected' : '' }}>
                        Bulan {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-grup">
            <select name="tahun" class="form-control">
                @for($i=2024;$i<=2030;$i++)
                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primer">Tampilkan</button>

    </form>

    <br>
    {{-- TABEL LAPORAN --}}
    <section class="tabel-box">
        <div class="tabel-header">
            <h3>Data Laporan</h3>
        </div>

        <div class="tabel-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Minggu ke-</th>
                        <th>Jumlah Transaksi</th>
                        <th>Omzet Mingguan</th>
                        <th>Produk Terlaris</th>
                        <th>Produk Kurang Laris</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($laporanMingguan as $laporan)

                    <tr>
                        <td>Minggu {{ $laporan->mingguke }}</td>
                        <td>{{ $laporan->jumlahTransaksi }}</td>
                        <td>Rp {{ number_format($laporan->omzetMingguan) }}</td>
                        <td>{{ $produkTerlaris }}</td>
                        <td>{{ $produkKurang }}</td>
                    </tr>

                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align:right;">
                            <strong>Total Omzet</strong>
                        </td>

                        <td colspan="5">
                            <strong>
                                Rp {{ number_format($totalOmzet) }}
                            </strong>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </section>

</div>

@endsection