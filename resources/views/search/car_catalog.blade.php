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
                        <form class="car-catalog__item" method="GET" action="{{ route('search.car.catalog.parts') }}" onclick="submit()">
                            <input type="hidden" name="groupId" value="{{ $data['groupId'] }}">
                            <input type="hidden" name="modelId" value="{{ $data['modelId'] }}">
                            <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">
                            <input type="hidden" name="frame" value="{{ $data['frame'] }}">
                            <input type="hidden" name="vin" value="{{ $data['vin'] }}">
                            <input type="hidden" name="type" value="{{ $data['type'] }}">
                            <input type="hidden" name="model" value="{{ $data['model'] }}">
                            <input type="hidden" name="modification" value="{{ $data['modification'] }}">
                            <input type="hidden" name="criteriaURI" value="{{ $data['criteriaURI'] }}">
                            <input type="hidden" name="mark" value="{{ $data['mark'] }}">
                            <input type="hidden" name="img " value="{{ $value['img'] }}">
                            <input type="hidden" name="subGroup" value="{{ $value['id'] }}">
                            <input type="hidden" name="test" value="test">


{{--                            <input type="hidden" name="catalogId" value="{{ $data['catalogId'] }}">--}}
{{--                            <input type="hidden" name="carId" value="{{ $data['carId'] }}">--}}
{{--                            <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">--}}
{{--                            <input type="hidden" name="groupId" value="{{ $value['id'] }}">--}}
{{--                            <input type="hidden" name="img " value="{{ $value['img'] }}">--}}
                            <div class="car-catalog__item-title">
                                {{ $value['name'] }}
                            </div>
                            <div class="car-catalog__item-img">
                                <img src="{{ $value['img'] }}" alt="catalog">
                            </div>
                        </form>
                        @else
                            <form class="car-catalog__item" method="GET" action="{{ route('search.car.catalog') }}" onclick="submit()">
                                <input type="hidden" name="groupId" value="{{ $value['id'] }}">
                                <input type="hidden" name="img " value="{{ $value['img'] }}">
                                <input type="hidden" name="modelId" value="{{ $data['modelId'] }}">
                                <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">
                                <input type="hidden" name="frame" value="{{ $data['frame'] }}">
                                <input type="hidden" name="vin" value="{{ $data['vin'] }}">
                                <input type="hidden" name="type" value="{{ $data['type'] }}">
                                <input type="hidden" name="model" value="{{ $data['model'] }}">
                                <input type="hidden" name="modification" value="{{ $data['modification'] }}">
                                <input type="hidden" name="criteriaURI" value="{{ $data['criteriaURI'] }}">
                                <input type="hidden" name="mark" value="{{ $data['mark'] }}">

{{--                                <input type="hidden" name="catalogId" value="{{ $data['catalogId'] }}">--}}
{{--                                <input type="hidden" name="carId" value="{{ $data['carId'] }}">--}}
{{--                                <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">--}}
{{--                                <input type="hidden" name="groupId" value="{{ $value['id'] }}">--}}
{{--                                <input type="hidden" name="img " value="{{ $value['img'] }}">--}}

                                <div class="car-catalog__item-title">
                                    {{ $value['name'] }}
                                </div>
                                <div class="car-catalog__item-img">
                                    <img src="{{ $value['img'] }}" alt="catalog">
                                </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            @else
                <p>Ничего не нашли</p>
            @endif
        </div>
    </main>
@endsection
