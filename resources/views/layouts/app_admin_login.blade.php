<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body>
<div id="app" class="outer-wrapper">
    <div class="login__exit">
        <a href="{{ route('index') }}">
            <img src="/storage/img/icons/login_exit.svg" alt="exit">
        </a>
    </div>
    <header class="header @yield('main-screen')">
        <div class="wrapper">
            @section('header')
                <ul class="header__logo-cart justify-content-center">
                    <li class="logo">
                        <a href="{{ route('index') }}">
                            <img src="/storage/img/logo.svg" alt="Логотип">
                        </a>
                    </li>
                </ul>
            @show

        </div>
        @yield('content')
    </header>
</div>
</body>
</html>
