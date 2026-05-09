<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index() {
        $users = User::query()->orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,kasir'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return back()->with('success', 'User baru berhasil ditambahkan!');
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:admin,kasir'],
        ]);

        $user->update($request->only('name', 'email', 'role'));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return back()->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(\App\Models\User $user) // Tambahkan backslash depan App
    {
        if (\Illuminate\Support\Facades\Auth::id() === $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        /** @var \App\Models\User $user */
        $user->delete();

        return back()->with('success', 'User telah dihapus secara permanen!');
    }
}