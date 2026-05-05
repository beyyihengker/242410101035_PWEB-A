<nav>
    <div class="nav-inner">
        <div class="nav-brand">
            <img src="{{ asset('images/IMG_7126.PNG') }}">
            <div class="brand-text">
                <h1>BeysWear Fashion</h1>
                <p>Sistem Manajemen Retail</p>
            </div>
        </div>

        <ul class="nav-menu">
            <li><a href="{{ route('dashboard') }}">Beranda</a></li>
            <li><a href="{{ route('penjualan') }}">Penjualan</a></li>
            <li><a href="{{ route('produk') }}">Produk</a></li>
            <li><a href="{{ route('laporan') }}">Laporan</a></li>
            <li><a href="{{ route('profil') }}">Profil</a></li>
        </ul>
    </div>
</nav>