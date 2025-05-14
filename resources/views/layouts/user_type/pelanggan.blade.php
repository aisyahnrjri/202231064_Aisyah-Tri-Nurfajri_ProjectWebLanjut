@extends('layouts.app')

@section('guest')
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    @include('authGuest.navbars.nav')
                </div>
            </div>
        </div>
        @yield('content')      
@endsection