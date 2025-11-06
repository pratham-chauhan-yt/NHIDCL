@extends('layouts.app')
@section('content')
    @if (isset($header))
        @include('shared.header')
    @endif
    <div class="main-container flex overflow-hidden bg_main_dash">
        @if (isset($sidebar))
            @include('shared.sidebar')
        @endif
        <section class="home-section">
            <div class="container-fluid">
                @yield('dashboard_content')
            </div>
             @yield('dashboard_contents')
        </section>
    </div>
    <footer class="bg-footer-color p-4">
        <div class="container">
            <p>@ {{ now()->year }} NHIDCL </p>
        </div>
    </footer>
@endsection
