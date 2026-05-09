<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profil', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], [
            'name.required'  => 'Nama lengkap tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'email.required' => 'Alamat email harus diisi.',
            'email.email'    => 'Format email salah.',
            'email.unique'   => 'Email ini sudah terdaftar di akun lain.',
        ]);

        $user->update([
            'name'  => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
        ]);

        return redirect()->route('profil')->with('success', 'Data profil kamu berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password'         => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.required' => 'Password saat ini harus diisi.',
            'current_password.current_password' => 'Password lama yang kamu masukkan salah.',
            'password.required'  => 'Password tidak boleh kosong.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min'       => 'Password minimal harus 8 karakter.',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profil')->with('success', 'Password kamu berhasil diganti!');
    }
}