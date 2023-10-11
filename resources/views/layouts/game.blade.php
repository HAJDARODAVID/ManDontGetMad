<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type = "text/css" href="{{ url('css/gameboard.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0px; margin:0px;">
            <a class="navbar-brand" href="{{ url('/') }}" style="margin-left:10px">
                Man don't get mad #00001
            </a>
            <ul class="navbar-nav ms-auto"  style="margin-top:3px; margin-top:2px;margin-right:5px">
            <li class="nav-item">
                <a class="nav-link" style="padding: 0px;" href="#">{{ __('Login') }}</a>
            </li>
            </ul>

        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
