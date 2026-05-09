<x-guest-layout>
    <div class="login-auth-container">
        <div class="sb-card animate-bounce-in" style="width: 100%; max-width: 400px; background: rgba(255, 255, 255, 0.95); padding: 40px; border-radius: 20px;">
            <h2 style="color: #112250; text-align: center; margin-bottom: 20px;">Atur Ulang Password</h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-grup" style="margin-bottom: 15px;">
                    <label class="sb-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly>
                </div>

                <div class="form-grup" style="margin-bottom: 15px;">
                    <label class="sb-label">Password Baru</label>
                    <input type="password" name="password" required autofocus>
                </div>

                <div class="form-grup" style="margin-bottom: 25px;">
                    <label class="sb-label">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primer" style="width: 100%; background: #112250; color: #E0C58F;">
                    RESET PASSWORD
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>