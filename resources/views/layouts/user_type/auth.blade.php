@extends('layouts.app')

@section('auth')

@auth('admin')
@include('layouts.navbars.auth.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
    @include('layouts.navbars.auth.nav')
    <div class="container-fluid py-4">
        @yield('content')
    </div>
</main>
@endauth
@auth('pelanggan')
@include('authGuest.navbars.auth.sidebar')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
    @include('authGuest.navbars.auth.nav')
    <div class="container-fluid py-4">
        @yield('content')
    </div>
</main>
@endauth

@include('components.fixed-plugin')



@endsection