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
                        <div class="admin__sort">
                            <form action="{{ route('admin.order.index') }}" method="GET">
{{--                                @csrf--}}
                                <label for="sort">Сортировать по</label>
                                <select name="sort" id="sort">
                                    <option value="date_up">По дате(сначала новые)</option>
                                    <option value="date_down">По дате(сначала старые)</option>
                                    <option value="total_up">По сумме(сначала дорогие)</option>
                                    <option value="total_down">По сумме(сначала дешевые)</option>
                                    <option value="status_new">По статусу(оформлен)</option>
                                    <option value="status_work">По статусу(в работе)</option>
                                    <option value="status_finish">По статусу(выполнен)</option>
                                </select>
                                <button type="submit">Применить</button>
                            </form>
                        </div>
                        <div class="result-table">
                            <div class="stocks-info-td">
                                <div class="tr">
                                    <div class="caption admin__caption admin__caption-id">
                                        Номер<br>заказа
                                    </div>
                                    <div class="caption admin__caption admin__caption-status">
                                        Статус<br>заказа
                                    </div>
                                    <div class="caption admin__caption admin__caption-name">
                                        Имя<br>заказчика
                                    </div>
                                    <div class="caption admin__caption admin__caption-price">
                                        Сумма<br>заказа
                                    </div>
                                    <div class="caption admin__caption admin__caption-date">
                                        Дата<br>оформления
                                    </div>
                                    <div class="caption admin__caption admin__caption-more">
                                        Подробнее
                                    </div>
                                </div>
                                @forelse($orders as $order)
                                <div class="tr">
                                    <div class="td admin__td admin__td-id">
                                        {{ $order->id }}
                                    </div>
                                    <div class="td admin__td admin__td-status">
                                        <form action="{{ route('admin.order.edit', $order) }}" method="POST" class="admin__status-form">
                                            @csrf
                                            <label for="status"></label>
                                            <select name="status" id="status">
                                                <option value="оформлен"
                                                @if($order->status === 'оформлен')
                                                    selected
                                                @endif
                                                >
                                                    оформлен
                                                </option>

                                                <option value="в работе"
                                                        @if($order->status === 'в работе')
                                                        selected
                                                        @endif
                                                >
                                                    в работе
                                                </option>
                                                <option value="выполнен"
                                                        @if($order->status === 'выполнен')
                                                        selected
                                                        @endif
                                                >
                                                    выполнен
                                                </option>
                                            </select>
                                            <button type="submit">сохранить</button>
                                        </form>
{{--                                        {{ $order->status }}--}}
                                    </div>
                                    <div class="td admin__td admin__td-name">
                                        {{ $order->name }}
                                    </div>
                                    <div class="td admin__td admin__td-price">
                                        {{ $order->total_price }}
                                    </div>
                                    <div class="td admin__td admin__td-date">
                                        {{ $order->created_at }}
                                    </div>
                                    <div class="td admin__td admin__td-more">
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
                        <div>
                            {{ $orders->links() }}
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
