@extends('layouts.app')

@section('title', 'Profil — BeysWear Fashion')

@section('content')
<div class="profil-wrap">

    <div class="sb-card profil-avatar-card">
        <div class="profil-avatar">
            {{ strtoupper(substr($profil['nama'], 0, 2)) }}
        </div>
        <div>
            <p class="profil-nama">{{ $profil['nama'] }}</p>
            <p class="profil-jabatan">{{ $profil['jabatan'] }}</p>
            <span class="profil-badge">BeysWear Fashion</span>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-error">
        <span>{{ $errors->first() }}</span>
        <button onclick="this.parentElement.remove()">×</button>
    </div>
    @endif

    <div class="sb-card">
        <p class="profil-section-title">Edit Profil</p>
        <form method="POST" action="{{ route('profil.update') }}">
            @csrf
            @method('PUT')

            <div class="profil-grid-2">
                <div class="form-grup">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama"
                        value="{{ old('nama', $profil['nama']) }}" required>
                    @error('nama')
                        <span class="form-err">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-grup">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan"
                        value="{{ old('jabatan', $profil['jabatan']) }}" required>
                    @error('jabatan')
                        <span class="form-err">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-grup">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email', $profil['email']) }}" required>
                @error('email')
                    <span class="form-err">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-grup">
                <label for="telepon">Nomor Telepon</label>
                <input type="tel" id="telepon" name="telepon"
                    value="{{ old('telepon', $profil['telepon']) }}" required>
                @error('telepon')
                    <span class="form-err">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primer" style="width:100%;margin-top:15px;">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <div class="sb-card">
        <p class="profil-section-title">Ubah Password</p>
        <form method="POST" action="{{ route('profil.password') }}">
            @csrf
            @method('PUT')

            <div class="form-grup">
                <label for="password_lama">Password Saat Ini</label>
                <input type="password" id="password_lama" name="password_lama"
                    placeholder="Masukkan password lama" required>
                @error('password_lama')
                    <span class="form-err">{{ $message }}</span>
                @enderror
            </div>

            <div class="profil-grid-2">
                <div class="form-grup">
                    <label for="password_baru">Password Baru</label>
                    <input type="password" id="password_baru" name="password_baru"
                        placeholder="Minimal 8 karakter" required>
                    @error('password_baru')
                        <span class="form-err">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-grup">
                    <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_baru_confirmation"
                        name="password_baru_confirmation"
                        placeholder="Ulangi password baru" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primer" style="width:100%;margin-top:15px;">
                Ubah Password
            </button>
        </form>
    </div>

</div>
@endsection