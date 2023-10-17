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
            <livewire:gameboard.gameboard-title lastName="{{ $myGameRoom }}" />
            <ul class="navbar-nav ms-auto"  style="margin-top:3px; margin-top:2px;margin-right:5px">
                @if (!session('gameRoom'))
                    <li class="nav-item">
                        <a class="nav-link" style="padding: 0px;padding-right: 10px" href="{{ route('gameboard') }}">
                            Game rooms
                        </a>
                    </li>  
                @endif
                
                @if (session('gameRoom'))
                    <li class="nav-item">
                        <livewire:gameboard.leave-room-button />
                    </li>   
                @endif
                <li class="nav-item">
                    <a class="nav-link" style="padding: 0px;padding-right: 10px" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>

        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
