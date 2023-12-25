@extends('layouts.app')

@section('content')
    <div class="w-full mx-auto h-screen grid grid-rows-layout">
        {{-- header --}}
        @include('layouts.partials.user-header')
        <div class="px-5">
            {{-- main --}}
            <main class="flex my-5 h-screen">
                @include('layouts.partials.sidebar')
                <div class="bg-gray-100 py-10 w-full mx-5 rounded-lg">

                    @yield('user.content')
                </div>
            </main>
        </div>
        {{-- footer --}}
        @include('layouts.partials.footer')


    </div>
@endsection
