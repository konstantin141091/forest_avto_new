@extends('layouts.app')
@section('page-title', 'Результаты поиска')

@section('content')
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
            <div class="search-results">
                <div class="main-product">
{{--                    заголовок--}}
                    <div class="title-block">
                        <h2 class="subtitle">Искомый товар</h2>
                        <ul class="sort">
                            <li>Сортировать по:</li>
                            <li class="current"><a>умолчанию</a></li>
                            <li><a href="#">цене</a></li>
                            <li><a href="#">бренду</a></li>
                        </ul>
                    </div>
                    {{--рендер товаров берга--}}
                    @forelse($berg_products as $brand_name)
                        <div class="result-table">
                            <div class="product-info-td">
                                <div class="tr">
                                    <div class="caption">Описание товара</div>
                                </div>
                                <div class="tr">
                                    <div class="td">
                                        <div class="product-info-td__title">{{ $brand_name[0]->brand_name }}
                                            <span>{{ $brand_name[0]->product_id }}</span>
                                        </div>
                                        <div class="product-info-td__desc">{{ $brand_name[0]->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="stocks-info-td">
                                <div class="tr">
                                    <div class="caption">Наличие</div>
                                    <div class="caption">Дата доставки</div>
                                    <div class="caption">Цена</div>
                                    <div class="caption">Кол-во</div>
                                </div>
                                @forelse($brand_name as $product)
                                    <product-component :product="{{$product}}"></product-component>
                                @empty

                                @endforelse
                            </div>

                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        @else
            <p>Ничего не нашли</p>
        @endif
    </div>
@endsection
