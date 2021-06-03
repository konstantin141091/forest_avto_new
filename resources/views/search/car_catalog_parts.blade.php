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
                <div class="d-flex">
                    <div>
                        <img src="{{ $parts['img'] }}" alt="parts">
                    </div>
                    <div>
                        @foreach($parts['partGroups'] as $parts_group)
                            <div>
                                <p>Группа деталий</p>
                                <p>Название группы: {{ $parts_group['name'] }}</p>
                                <p>Расположение группы на схеме: {{ $parts_group['positionNumber'] }}</p>
                                <p>Список запчастей группы</p>
                                @foreach($parts_group['parts'] as $part)
                                    <div>
                                        <p>Артикул {{ $part['number'] }}</p>
                                        <p>Расположение запчасти на схеме {{ $part['positionNumber'] }}</p>
                                        <form action="{{ route('search.artikul') }}" method="POST" target="_blank">
                                            @csrf
                                            <input type="hidden" name="artikul" value="{{ $part['number'] }}">
                                            <button type="submit">Найти</button>
                                        </form>
                                    </div>
                                @endforeach
                                <hr>
                            </div>
                        @endforeach
                    </div>

                </div>
            @else
                <p>Ничего не нашли</p>
            @endif
        </div>
    </main>
@endsection
