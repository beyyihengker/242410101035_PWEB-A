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
            'no_hp' => $request->no_hp,
            'role' => 'kasir',
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'User baru berhasil ditambahkan!');
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'no_hp' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($request->only('name', 'email', 'no_hp'));

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return back()->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()
                ->back()
                ->with('error', 'Kamu tidak bisa menghapus akunmu sendiri.');
        }

        if ($user->role === 'admin') {
            return redirect()
                ->back()
                ->with('error', 'Akun admin tidak boleh dihapus.');
        }

        $user->delete();

        return redirect()
            ->back()
            ->with('success', 'User berhasil dihapus.');
    }
}