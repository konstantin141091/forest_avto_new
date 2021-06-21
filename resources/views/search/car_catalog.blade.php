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
                <div class="car-catalog">
                    @foreach($catalog as $index => $value)
                        @if($value['hasParts'])
                        <form class="car-catalog__item" method="POST" action="{{ route('search.car.catalog.parts') }}" onclick="submit()">
                            @csrf
                            <input type="hidden" name="catalogId" value="{{ $data['catalogId'] }}">
                            <input type="hidden" name="carId" value="{{ $data['carId'] }}">
                            <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">
                            <input type="hidden" name="groupId" value="{{ $value['id'] }}">
                            <input type="hidden" name="img " value="{{ $value['img'] }}">
                            <div class="car-catalog__item-title">
                                {{ $value['name'] }}
                            </div>
                            <div class="car-catalog__item-img">
                                <img src="{{ $value['img'] }}" alt="catalog">
                            </div>
                        </form>
                        @else
                            <form class="car-catalog__item" method="POST" action="{{ route('search.car.catalog') }}" onclick="submit()">
                                @csrf
                                <input type="hidden" name="catalogId" value="{{ $data['catalogId'] }}">
                                <input type="hidden" name="carId" value="{{ $data['carId'] }}">
                                <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">
                                <input type="hidden" name="groupId" value="{{ $value['id'] }}">
                                <input type="hidden" name="img " value="{{ $value['img'] }}">

                                <div class="car-catalog__item-title">
                                    {{ $value['name'] }}
                                </div>
                                <div class="car-catalog__item-img">
                                    <img src="{{ $value['img'] }}" alt="catalog">
                                </div>
                            </form>
                        @endif
{{--                        @if($value['hasParts'])--}}
{{--                            <form action="{{ route('search.car.catalog.parts') }}" method="POST" id="catalog-{{ $index }}">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="catalogId" value="{{ $data['catalogId'] }}">--}}
{{--                                <input type="hidden" name="carId" value="{{ $data['carId'] }}">--}}
{{--                                <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">--}}
{{--                                <input type="hidden" name="groupId" value="{{ $value['id'] }}">--}}
{{--                                <input type="hidden" name="img " value="{{ $value['img'] }}">--}}
{{--                                <button type="submit" hidden >Подробнее</button>--}}
{{--                            </form>--}}
{{--                        @else--}}
{{--                            <form action="{{ route('search.car.catalog') }}" method="POST" id="catalog-{{ $index }}">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="catalogId" value="{{ $data['catalogId'] }}">--}}
{{--                                <input type="hidden" name="carId" value="{{ $data['carId'] }}">--}}
{{--                                <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">--}}
{{--                                <input type="hidden" name="groupId" value="{{ $value['id'] }}">--}}
{{--                                <input type="hidden" name="img " value="{{ $value['img'] }}">--}}
{{--                                <button type="submit" hidden  >Подробнее</button>--}}
{{--                            </form>--}}
{{--                        @endif--}}
                    @endforeach
                </div>
            @else
                <p>Ничего не нашли</p>
            @endif
        </div>
{{--        <script src="{{ asset('js/scripts/catalog_select.js') }}"></script>--}}
    </main>
@endsection
