<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'BeysWear Fashion')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body>

    @include('partials.navbar')

    <div class="page-container">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 20px;">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        @yield('content')
    </div>

    <footer>
        <div class="footer-grid">

            <div class="footer-col">
                <h4>BeysWear Fashion</h4>
                <p> Retail fashion. </p>
                <p style="margin-top:12px;">
                    📍 Jl. Jawa No. 1, Jember<br>
                    📞 0812-3456-7890<br>
                    ✉ info@beyswear.com
                </p>
            </div>

            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li><a href="{{ route('penjualan') }}">Penjualan</a></li>
                    <li><a href="{{ route('produk') }}">Manajemen Produk</a></li>
                    <li><a href="{{ route('laporan') }}">Laporan & Statistik</a></li>
                    <li><a href="{{ route('profil') }}">Pengaturan Akun</a></li>
                </ul>
            </div>
        </div>

        <p class="footer-bottom"> &copy; 2026 <strong>BeysWear Fashion</strong>. Semua hak dilindungi.
        </p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')

</body>
</html>