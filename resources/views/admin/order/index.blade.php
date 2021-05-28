@extends('layouts.app_admin')
@section('page-title', 'Админ-панель сайта | Заказы')

@section('content')
    <div class="wrapper">
        <div class="admin">
            <div class="admin__container">
                <div class="admin__site-bar">
                    <nav class="admin__menu">
                        <div class="admin__login">
                            <div class="admin__contacts">
                                <p>{{ Auth::user()->name }}</p>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Выйти</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            <ul class="admin__menu-ul">
                                <li class="admin__menu-li">
                                    <a href="#" class="admin__menu-link admin__menu-link-selected">Просмотр заказов</a>
                                </li>
                                <li class="admin__menu-li">
                                    <a href="#" class="admin__menu-link">Просто ссылка</a>
                                </li>
                                <li class="admin__menu-li">
                                    <a href="#" class="admin__menu-link">Возможный функционал</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="admin__content">
                    <h1>Просмотр заказов</h1>
                    <div class="admin__orders">
                        <div class="result-table">
                            <div class="stocks-info-td">
                                <div class="tr">
                                    <div class="caption admin__caption">
                                        Номер<br>заказа
                                    </div>
                                    <div class="caption admin__caption">
                                        Статус<br>заказа
                                    </div>
                                    <div class="caption admin__caption">
                                        Имя<br>заказчика
                                    </div>
                                    <div class="caption admin__caption">
                                        Сумма<br>заказа
                                    </div>
                                    <div class="caption admin__caption">
                                        Дата<br>оформления
                                    </div>
                                    <div class="caption admin__caption">
                                        Подробнее
                                    </div>
                                </div>
                                @forelse($orders as $order)
                                <div class="tr">
                                    <div class="td admin__td">
                                        {{ $order->id }}
                                    </div>
                                    <div class="td admin__td">
                                        {{ $order->status }}
                                    </div>
                                    <div class="td admin__td">
                                        {{ $order->name }}
                                    </div>
                                    <div class="td">
                                        {{ $order->total_price }}
                                    </div>
                                    <div class="td admin__td">
                                        {{ $order->created_at }}
                                    </div>
                                    <div class="td admin__td">
                                        <a href="{{ route('admin.order.show', $order) }}">
                                            Посмотреть заказ
                                        </a>
                                    </div>
                                </div>
                                @empty
                                    <div>Ничего нет</div>
                                @endforelse
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



{{--        <h1>Админка сайта</h1>--}}
{{--        <h2>формленные заказы</h2>--}}
{{--        @forelse($orders as $order)--}}
{{--            <div>--}}
{{--                <p>Номер заказа: {{ $order->id }}</p>--}}
{{--                <p>Статус заказа: {{ $order->status }}</p>--}}
{{--                <p>Имя заказчика: {{ $order->name }}</p>--}}
{{--                <p>Сумма заказа: {{ $order->total_price }}</p>--}}
{{--                <p>Дата оформления: {{ $order->created_at }}</p>--}}
{{--                <a href="{{ route('admin.order.show', $order) }}">Посмотреть заказ</a>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--        @empty--}}
{{--           <div>--}}
{{--               <p>Заказов нет</p>--}}
{{--           </div>--}}
{{--        @endforelse--}}
    </div>
@endsection
