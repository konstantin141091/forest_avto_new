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
    <header class="header @yield('main-screen')">
        <div class="wrapper">
            @section('header')
                <ul class="header__contact">
                    <li class="header__city">
                        <i class="icon-font icon-map"></i> Чита <i class="icon-font icon-down-open-mini"></i>
                    </li>
                    <li class="header__callback">
                        <a href="#"><i class="icon-font icon-callback"></i> Обратная связь</a>
                    </li>
                    <li class="header__phone">
                        <a href="tel:+7 925 755 53 59">
                            <i class="icon-font icon-phone"></i>
                            <span>+7 925 755 53 59</span>
                        </a>
                    </li>
                </ul>
                <ul class="header__logo-cart">
                    <li class="logo">
                        <a href="{{ route('index') }}">
                            <img src="/storage/img/logo.svg" alt="Логотип">
                        </a>
                    </li>
                    <cart-header-component :url="'{{ route('cart.index') }}'"></cart-header-component>
                </ul>
                <nav class="header__main-nav main-nav">
                    <li class="main-nav__item main-nav__item--catalog-item">
                        <a href="#"><i class="icon-font icon-catalog-icon"></i> Каталог товаров</a>
                    </li>
                    <li class="main-nav__item"><a href="#">Общий каталог</a></li>
                    <li class="main-nav__item"><a href="#">Поиск по VIN</a></li>
                    <li class="main-nav__item"><a href="#">Быстрый поиск</a></li>
                    <li class="main-nav__item"><a href="#">Доставка и оплата</a></li>
                    <li class="main-nav__item"><a href="#">Контакты</a></li>
                </nav>
            @show
        </div>
    </header>
    @yield('content')

</div>
</body>
</html>
