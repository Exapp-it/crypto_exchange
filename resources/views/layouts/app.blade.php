<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/js/app.js')
    @include('settings.main')
</head>

<body x-data="Modal()" class="font-main bg-stone-200">

<div class="max-w-screen-xl mx-auto h-screen grid grid-rows-layout">
    {{--header--}}
    @include('layouts.partials.header')

    {{--banner--}}
    @if (!request()->routeIs('password.reset'))
        @include('layouts.partials.banner')
    @endif

    {{--main--}}
    <main class="lg:flex lg:space-x-2">
        @yield('content')
        @if (!request()->routeIs('password.reset'))
            @include('layouts.partials.right-block')
        @endif
    </main>

    {{--footer--}}
    @include('layouts.partials.footer')


        @include('auth.login-modal')
        @include('auth.register-modal')
        @include('auth.forgot-modal')

</div>

</body>
</html>



