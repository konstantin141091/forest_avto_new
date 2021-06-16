@extends('layouts.app')
@section('page-title', 'Результаты поиска')

@section('content')
    <main>
        <div class="wrapper">
            <h1 class="page-title">Результаты поиска</h1>
            <p class="product-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.
            </p>
            <ul class="product-advs">
                <li class="product-advs__item">
                    <img src="/storage/img/box.svg" alt="Доставка">
                    <span class="product-advs__text">Доставка</span>
                </li>

                <li class="product-advs__item">
                    <img src="/storage/img/shield-game.svg" alt="Гарантия">
                    <span class="product-advs__text">Гарантия</span>
                </li>
            </ul>
            @if($success)
                @if($products['original'])
                    <h2>Оригинальные запчасти по {{ $article }}</h2>
                    <div class="search-results">
                        <div class="main-product">
                            <div class="title-block">
                                <h2 class="subtitle">Искомый товар</h2>
                                <product-sort-component :type="'original'"></product-sort-component>
                            </div>
                            <products-list-component :products="{{ json_encode($products['original']) }}" :type="'original'" ref="productListOriginal"></products-list-component>
                        </div>
                    </div>
                @endif

                @if(!empty($products['analog']))
                    <h2>Аналоги по {{ $article }}</h2>
                    <div class="search-results">
                        <div class="main-product">
                            <div class="title-block">
                                <h2 class="subtitle">Искомый товар</h2>
                                <product-sort-component :type="'analog'"></product-sort-component>
                            </div>
                            <products-list-component :products="{{ json_encode($products['analog']) }}" :type="'analog'" ref="productListAnalog"></products-list-component>
                        </div>
                    </div>
                @endif

            @else
                <p>Ничего не нашли</p>
            @endif
        </div>
    </main>
@endsection
