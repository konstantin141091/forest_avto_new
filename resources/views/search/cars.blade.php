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
                        <div class="result-table result-table-car">
                            <div class="product-info-td product-info-td-car">
                                <div class="tr">
                                    <div class="caption caption-car">
                                        Название автомобиля
                                    </div>
                                </div>
                                <div class="tr">
                                    <div class="td">
                                        <div class="product-info-td__title product-info-td__title-car">
                                            {{ $car['brand'] }} {{ $car['title'] }}
                                        </div>
                                        <div class="product-info-td__desc">
                                            {{ $car['frame'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="stocks-info-td stocks-info-td-car">
                                <div class="tr tr-info">
                                    <div class="caption caption__year">
                                        Год
                                    </div>
                                    <div class="caption caption__engine">
                                        Двигатель
                                    </div>
                                    <div class="caption caption__region">
                                        Регион
                                    </div>
                                    <div class="caption caption__kp">
                                        Тип коробки передач
                                    </div>
                                    <div class="caption caption__more">
                                        Посмотреть
                                    </div>
                                </div>
                                <div class="tr tr-details">
                                    <div class="td td__year">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'year')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="td td__engine">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'engine')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="td td__region">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'sales_region')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="td td__kp">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'trans_type')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="td td__more">
                                        <form action="{{ route('search.car.categories') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="catalogId" value="{{ $car['catalogId'] }}">
                                            <input type="hidden" name="carId" value="{{ $car['carId'] }}">
                                            <input type="hidden" name="criteria" value="{{ $car['criteria'] }}">
                                            <input type="hidden" name="frame" value="{{ $car['frame'] }}">
                                            <input type="hidden" name="vin" value="{{ $car['vin'] }}">
                                            <button type="submit">Посмотреть</button>
                                        </form>
                                    </div>
                                </div>

{{--                                mobile version--}}
                                <div class="tr tr-details-mobile">
                                    <div class="caption caption__year">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'year')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="caption caption__engine">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'engine')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="caption caption__region">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'sales_region')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="caption caption__kp">
                                        @foreach($car['parameters'] as $value)
                                            @if($value['key'] === 'trans_type')
                                                {{ $value['value'] }}
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="caption caption__more">
                                        <form action="{{ route('search.car.categories') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="catalogId" value="{{ $car['catalogId'] }}">
                                            <input type="hidden" name="carId" value="{{ $car['carId'] }}">
                                            <input type="hidden" name="criteria" value="{{ $car['criteria'] }}">
                                            <input type="hidden" name="frame" value="{{ $car['frame'] }}">
                                            <input type="hidden" name="vin" value="{{ $car['vin'] }}">
                                            <button type="submit">Посмотреть</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
