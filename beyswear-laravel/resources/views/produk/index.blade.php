@extends('layouts.app')

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
    <div class="tabel-header">
        <h1>Data Produk</h1>

        <a href="{{ route('produk.create') }}" class="btn-primary">
            + Tambah Produk
        </a>
    </div>

    <div class="tabel-scroll">

        <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($produk as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            @if($item->foto)

                                <img src="{{ asset('storage/' . $item->foto) }}" width="80" class="foto-produk">

                            @else

                                <span class="text-muted">
                                    Tidak ada foto
                                </span>

                            @endif

                        </td>

                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>Rp {{ number_format($item->harga) }}</td>

                        <td>

                            <div class="aksi-btn">

                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-primer">Detail</a>

                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-primer">Edit</a>

                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-primer" style="background:#c0392b;" onclick="return confirm('Yakin hapus produk?')">Hapus</button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

        </table>

    </div>

        <div class="pagination-box">
            {{ $produk->links() }}
        </div>

</section>

@endsection