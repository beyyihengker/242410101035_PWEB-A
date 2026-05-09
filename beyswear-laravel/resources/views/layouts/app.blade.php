<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'BeysWear Fashion')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body class="{{ Auth::check() ? 'dashboard-body' : 'landing-page-body' }}">

    @auth
        @include('partials.navbar')
    @endauth

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

    <main class="{{ Auth::check() ? 'page-container' : '' }}">
        @yield('content')
    </main>

    @Auth
        @include('partials.footer')
    @endauth

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