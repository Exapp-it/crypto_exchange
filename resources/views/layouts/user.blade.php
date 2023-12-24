@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto h-screen grid grid-rows-layout">
        {{-- header --}}
        @include('layouts.partials.user-header')
        <div class="px-5">
            {{-- main --}}
            <main class="container mx-auto">
                @include('layouts.partials.sidebar')
                @yield('user.content')
            </main>
        </div>

    </div>
@endsection
