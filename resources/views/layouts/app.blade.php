<!doctype html>
<html class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('settings.main')
    @vite('resources/js/app.js')
</head>

<body class="font-main">
    @yield('content')
</body>

</html>
