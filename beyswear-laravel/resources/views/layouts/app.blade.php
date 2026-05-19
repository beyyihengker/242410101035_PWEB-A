<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'BeysWear Fashion')</title>

    <script>

        if(
            document.cookie.includes(
                'theme=dark'
            )
        ){

            document.documentElement
                .classList.add('dark');
        }

    </script>
    
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

    @auth
        @include('partials.footer')
    @endauth

   {{-- JS utama --}}
   <script src="{{ asset('js/script.js') }}"></script>

   {{-- Lucide icons --}}
   <script src="https://unpkg.com/lucide@latest"></script>
   <script>
       document.addEventListener('DOMContentLoaded', function () {
           lucide.createIcons();
       });

       // Flash message auto hide
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

   {{-- Script tambahan dari halaman --}}
   @stack('scripts')

</body>
</html>