@extends('layouts.app')

@section('content')

<section class="form-box">

    <div class="tabel-header">
        <h1>Produk Terhapus</h1>

        <a href="{{ route('produk.index') }}" class="btn-primary">
            Kembali
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
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($produk as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}"
                                width="80"
                                class="foto-produk">
                        @else
                            Tidak ada foto
                        @endif
                    </td>

                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->kategori }}</td>

                    <td>
                        Rp {{ number_format($item->harga) }}
                    </td>

                    <td class="aksi-btn">
                        <form action="{{ route('produk.restore', $item->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <button type="submit" class="btn btn-primer">
                                Restore
                            </button>
                        </form>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" style="text-align:center;">
                        Tidak ada produk terhapus.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</section>

@endsection