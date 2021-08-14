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
                <div class="result-table">
                    <div class="stocks-info-td">
                        @foreach($categories as $catalog)
                            <div class="tr tr__category">
                                <div class="td td__category">{{ $catalog['name'] }}</div>
                                <div class="td td__category-more">
                                    <form action="{{ route('search.car.catalog') }}" method="GET">
                                        <input type="hidden" name="groupId" value="{{ $catalog['id'] }}">
                                        <input type="hidden" name="modelId" value="{{ $data['modelId'] }}">
                                        <input type="hidden" name="criteria" value="{{ $data['criteria'] }}">
                                        <input type="hidden" name="frame" value="{{ $data['frame'] }}">
                                        <input type="hidden" name="vin" value="{{ $data['vin'] }}">
                                        <input type="hidden" name="type" value="{{ $data['type'] }}">
                                        <input type="hidden" name="model" value="{{ $data['model'] }}">
                                        <input type="hidden" name="modification" value="{{ $data['modification'] }}">
                                        <input type="hidden" name="criteriaURI" value="{{ $data['criteriaURI'] }}">
                                        <input type="hidden" name="mark" value="{{ $data['mark'] }}">

                                        <button type="submit" class="button-category">Подробнее</button>
                                    </form>
                                </div>

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
