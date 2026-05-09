@extends('layouts.app')

@section('content')
<div class="hero-fullscreen">
    <div class="hero-content-fix animate-bounce-in">
        <h2 style="font-size: 72px; color: #E0C58F; letter-spacing: 8px;">BEYSWEAR</h2>
        <p style="font-size: 1.4rem; color: #E0C58F; margin-bottom: 30px; font-weight: 300;">Sistem Kasir Toko Beyswear</p>

        <div style="margin-top: 40px;">
            <a href="{{ route('login') }}" class="btn btn-primer"> Mulai Sekarang</a>
        </div>
    </div>
</div>

@endsection