<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = session('profil', [
            'nama'    => 'Beyyi',
            'email'   => 'beyswear@gmail.com',
            'telepon' => '082175024572',
            'jabatan' => 'Owner',
        ]);

        return view('profil', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'telepon' => 'required|string|max:20',
            'jabatan' => 'required|string|max:50',
        ], [
            'nama.required'    => 'Nama lengkap wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
        ]);

        session(['profil' => $request->only('nama', 'email', 'telepon', 'jabatan')]);

        return redirect()->route('profil.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ], [
            'password_lama.required'  => 'Password saat ini wajib diisi.',
            'password_baru.required'  => 'Password baru wajib diisi.',
            'password_baru.min'       => 'Password baru minimal 8 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        return redirect()->route('profil.index')
            ->with('success', 'Password berhasil diubah.');
    }
}