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
                <div class="search-results">
                    @forelse($cars as $car)
                        <div>
                            <p>
                                Название: {{ $car['brand'] }} {{ $car['title'] }}
                                @foreach($car['parameters'] as $value)
                                    @if($value['key'] === 'year')

                                        {{ $value['value'] }} год
                                    @endif
                                @endforeach
                            </p>
                            <p>Здесь можно еще доп инфу вывести, двигатель, тип корбки передач</p>
                            <form action="{{ route('search.car.categories') }}" method="POST">
                                @csrf
                                <input type="hidden" name="catalogId" value="{{ $car['catalogId'] }}">
                                <input type="hidden" name="carId" value="{{ $car['carId'] }}">
                                <input type="hidden" name="criteria" value="{{ $car['criteria'] }}">
                                <input type="hidden" name="frame" value="{{ $car['frame'] }}">
                                <input type="hidden" name="vin" value="{{ $car['vin'] }}">
                                <button type="submit">Подробнее</button>
                            </form>
                        </div>
                    @empty
                    @endforelse

                </div>

            @else
                <p>Ничего не нашли</p>
            @endif
        </div>
    </main>
@endsection
