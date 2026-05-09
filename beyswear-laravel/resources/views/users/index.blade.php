@extends('layouts.app')

@section('content')
<div class="page-container">
    <div class="sb-card">
        <p class="sb-title">MANAJEMEN USER BEYSWEAR</p>
        <button class="btn btn-primer" onclick="toggleModal('addModal')">+ Tambah User Baru</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="tabel-box">
        <div class="tabel-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td><span class="badge">{{ $u->role }}</span></td>
                        <td class="aksi-btn">
                            <button class="btn btn-sekunder" onclick="editUser({{ $u }})">Edit</button>
                            <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini secara permanen?')">
                                @csrf @method('delete')
                                <button type="submit" class="btn btn-primer" style="background:#c0392b;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit (Contoh Sederhana) -->
<div id="userModal" class="fixed-popup" style="display:none; background:white; padding:20px; border:1px solid #ddd;">
    <h3 id="modalTitle">Tambah User</h3>
    <form id="userForm" method="POST" action="{{ route('users.store') }}">
        @csrf
        <div id="methodField"></div>
        <div class="form-grup">
            <label>Nama</label>
            <input type="text" name="name" id="userName" required>
        </div>
        <div class="form-grup">
            <label>Email</label>
            <input type="email" name="email" id="userEmail" required>
        </div>
        <div class="form-grup">
            <label>Role</label>
            <select name="role" id="userRole">
                <option value="kasir">Kasir</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="form-grup">
            <label>Password (Kosongkan jika tidak ganti)</label>
            <input type="password" name="password">
        </div>
        <div style="margin-top:15px;">
            <button type="submit" class="btn btn-primer">Simpan</button>
            <button type="button" class="btn btn-sekunder" onclick="closeModal()">Batal</button>
        </div>
    </form>
</div>

@endsection