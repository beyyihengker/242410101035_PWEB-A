<nav>
    <div class="nav-inner">
        {{-- Sisi Kiri --}}
        <div class="nav-brand">
            <img src="{{ asset('images/IMG_7126.PNG') }}">
            <div class="brand-text">
                <h1>BeysWear Fashion</h1>
                <p>Sistem Manajemen Retail</p>
            </div>
        </div>

        @auth
            {{-- Sisi Kanan --}}
            <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'aktif' : '' }}">Beranda</a></li>
                <li><a href="{{ route('penjualan') }}" class="{{ request()->routeIs('penjualan') ? 'aktif' : '' }}">Penjualan</a></li>
                <li><a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'aktif' : '' }}">Produk</a></li>

                {{-- Filter Role Admin --}}
                @if(Auth::user()->role === 'admin')
                    <li><a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'aktif' : '' }}">Laporan</a></li>
                @endif

                {{-- Dropdown Profil Bulat --}}
                <li class="dropdown">
                    <div class="avatar-circle">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="dropdown-content">
                        <div class="dropdown-header">
                            <p class="user-name">Halo, {{ Auth::user()->name }}!</p>
                            <p class="user-email" style="font-size: 10px; color: #888;">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('profil') }}" class="dropdown-item">Profil Saya</a>

                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('users.index') }}" class="dropdown-item">Manajemen User</a>
                        @endif

                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn" style="width: 100%; text-align: left; border: none; background: none; cursor: pointer; font-family: inherit;">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        @endauth
    </div>
</nav>