@extends('layouts.app')

@section('content')
    <div x-data="Modal" class="w-full mx-auto h-screen grid grid-rows-layout">
        {{-- header --}}
        <div class="px-5">

            @guest
                @include('layouts.partials.header')
            @endguest
            @auth
                @include('layouts.partials.user-header')
            @endauth
            @include('layouts.partials.hero')

            {{-- main --}}
            <main class="container mx-auto">
                @yield('home.content')
            </main>

        </div>
        {{-- footer --}}
        @include('layouts.partials.footer')
        @include('auth.login-modal')
        @include('auth.register-modal')
        @include('auth.forgot-modal')
    </div>
@endsection
