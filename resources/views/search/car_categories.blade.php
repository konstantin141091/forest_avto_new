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
                <div>
                    @foreach($categories as $catalog)
                        <p>{{ $catalog['name'] }}</p>
                        <form action="{{ route('search.car.catalog') }}" method="POST">
                            @csrf
                            <input type="hidden" name="groupId" value="{{ $catalog['id'] }}">
                            <input type="hidden" name="catalogId" value="{{ $data['catalogId'] }}">
                            <input type="hidden" name="carId" value="{{ $data['carId'] }}">
                            <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">
                            <button type="submit">Подробнее</button>
                        </form>
                    @endforeach
                </div>
            @else
                <p>Ничего не нашли</p>
            @endif
        </div>
    </main>
@endsection
