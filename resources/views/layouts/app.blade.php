<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('settings.main')
    @vite('resources/js/app.js')
</head>

<body x-data="Modal()" class="font-main">
    <div class="w-full mx-auto h-screen grid grid-rows-layout">
        {{-- header --}}
        <div class="container mx-auto px-5">
            @include('layouts.partials.header')


            {{-- main --}}
            <main>
                @yield('content')
            </main>

            {{-- footer --}}
            @include('layouts.partials.footer')
        </div>

    </div>



    @include('auth.login-modal')
    @include('auth.register-modal')
    @include('auth.forgot-modal')


</body>

</html>
