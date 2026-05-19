<nav>
    <div class="nav-inner">
        <div class="nav-brand">
            <img src="{{ asset('images/IMG_7126.PNG') }}">
            <div class="brand-text">
                <h1>BeysWear Fashion</h1>
                <p>Sistem Manajemen Retail</p>
            </div>
        </div>

        @auth
            <ul class="nav-menu">
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'aktif' : '' }}">Beranda</a></li>
                <li><a href="{{ route('penjualan') }}" class="{{ request()->routeIs('penjualan') ? 'aktif' : '' }}">Penjualan</a></li>
                <li><a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'aktif' : '' }}">Produk</a></li>

                @if(Auth::user()->role === 'admin')
                    <li><a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'aktif' : '' }}">Laporan</a></li>
                @endif

                <li class="nav-item-dropdown" id="navDropdown">
                    <div class="avatar-circle nav-dropdown-toggle">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="dropdown-content nav-dropdown-menu">
                        <div class="nav-dropdown-header">
                            <p class="user-name">Halo, {{ Auth::user()->name }}!</p>
                            <p class="user-email" style="font-size: 10px; color: #888;">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="nav-dropdown-divider"></div>
                        <a href="{{ route('profil') }}" class="nav-dropdown-item">Profil Saya</a>

                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('users.index') }}" class="nav-dropdown-item">Manajemen User</a>
                        @endif
                        <button id="darkToggle" type="button" class="theme-switch">
                            <span class="theme-icon">☀</span>
                        </button>
                        <div class="nav-dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-dropdown-item logout-btn" style="width: 100%; text-align: left; border: none; background: none; cursor: pointer; font-family: inherit;">
                                    Logout
                                </button>
                            </form>
                    </div>
                </li>
            </ul>
        @endauth
    </div>
</nav>