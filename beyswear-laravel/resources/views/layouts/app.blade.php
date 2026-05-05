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
        @if (session('success'))
            <div id="flash-message" class="alert alert-success fixed-popup animate-bounce-in" role="alert">
                <div style="display: flex; align-items: center;">
                    <i data-lucide="check-circle" style="width: 18px; margin-right: 10px;"></i>
                    {{ session('success') }}
                </div>
                <button type="button" onclick="document.getElementById('flash-message').remove()">
                    <i data-lucide="x" style="width: 16px;"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="flash-message" class="alert alert-error fixed-popup animate-bounce-in" role="alert">
                <div style="display: flex; align-items: center;">
                    <i data-lucide="alert-circle" style="width: 18px; margin-right: 10px;"></i>
                    {{ session('error') }}
                </div>
                <button type="button" onclick="document.getElementById('flash-message').remove()">
                    <i data-lucide="x" style="width: 16px;"></i>
                </button>
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

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = "all 0.6s ease";
                flash.style.opacity = "0";
                flash.style.transform = "translateX(50px)";

                setTimeout(() => flash.remove(), 600);
            }
        }, 5000);
    </script>

    @stack('scripts')

</body>
</html>