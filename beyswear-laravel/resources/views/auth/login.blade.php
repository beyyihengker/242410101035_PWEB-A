<x-guest-layout>
    <div class="login-auth-container">
        <div class="sb-card animate-bounce-in" style="width: 100%; max-width: 400px; background: rgba(255, 255, 255, 0.95); border-radius: 20px; padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">

            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="font-family: 'Cormorant Garamond', serif; color: #112250; font-weight: bold; font-size: 1.8rem;">Login BeysWear</h2>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-grup" style="margin-bottom: 20px;">
                    <label class="sb-label">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email anda">
                    <x-input-error :messages="$errors->get('email')" class="form-err" />
                </div>

                <!-- Password -->
                <div class="form-grup" style="margin-bottom: 15px;">
                    <label class="sb-label">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="form-err" />
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size: 0.8rem; color: #3C507D; font-weight: 600;">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primer" style="width: 100%; height: 45px; background: #112250; color: #E0C58F; font-size: 1rem; letter-spacing: 1px;">
                    MASUK
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>