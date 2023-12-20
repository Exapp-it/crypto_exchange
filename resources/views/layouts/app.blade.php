<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('settings.main')
    @vite('resources/js/app.js')
</head>

<body x-data="Modal()" class="font-main bg-stone-200">

        {{-- header --}}
        @include('layouts.partials.header')


        {{-- main --}}
            @yield('content')

        {{-- footer --}}
        @include('layouts.partials.footer')


        @include('auth.login-modal')
        @include('auth.register-modal')
        @include('auth.forgot-modal')


</body>

</html>
