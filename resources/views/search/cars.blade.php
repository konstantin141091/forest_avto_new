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
                            <p>{{ $car->mark }} {{ $car->model }}</p>
                            <form action="{{ route('search.car') }}" method="POST">
                                @csrf
                                <input type="hidden" name="ssd" value="{{ $car->ssd }}">
                                <input type="hidden" name="link" value="{{ $car->link }}">
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
