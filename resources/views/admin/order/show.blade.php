@extends('layouts.app_admin')
@section('page-title', 'Админ-панель сайта | Просмотр заказа')

@section('content')
    <div class="wrapper">
        <h1>Админка сайта</h1>
        <h2>Детали заказа</h2>
        <div>
            <p>Номер заказа: {{ $order->id }}</p>
            <p>Статус заказа: {{ $order->status }}</p>
            <p>Имя заказчика: {{ $order->name }}</p>
            <p>Сумма заказа: {{ $order->total_price }}</p>
            <p>Дата оформления: {{ $order->created_at }}</p>
        </div>
        <hr>
        @forelse($products as $product)
            <div>
                <p>Артикул товара: {{ $product->article }}</p>
                <p>
                    ID в магазине: {{ $product->product_id }}
                    @if($product->shop_name === 'rossko')
                        (Можно по этому id найти товар на сайте Росско)
                    @endif
                </p>
                <p>ID склада в магазине: {{ $product->offers_id }}</p>
                <p>Название склада в магазине: {{ $product->offers_name }}</p>
                <p>Название товара: {{ $product->name }}</p>
                <p>Бренд товара: {{ $product->brand_name }}</p>
                <p>Название магазина: {{ $product->shop_name }}</p>
                <p>Количество: {{ $product->quantity }}</p>
                <p>Количество на складе: {{ $product->offers_quantity }}</p>
                <p>Дней доставки у поставщика: {{ $product->offers_average_period }}</p>
                <p>Дата доставки у поставщика: {{ $product->offers_assured_period }}</p>
                <p>Цена за товар: {{ $product->offers_price }}</p>
                <p>Итого по этому товару: {{ $product->total }}</p>
                <form action="{{ route('admin.order.product.status.edit', $product) }}" method="POST">
                    @csrf
                    <label for="status">Статус заказа детали</label>
                    <select name="status" id="status">
                        <option value="не заказан"
                                @if($product->status === 'не заказан')
                                selected
                                @endif>
                            не заказан
                        </option>
                        <option value="заказан через апи"
                                @if($product->status === 'заказан через апи')
                                selected
                                @endif>
                            заказан через апи
                        </option>
                        <option value="сам заказал"
                                @if($product->status === 'сам заказал')
                                selected
                                @endif>
                            сам заказал
                        </option>
                    </select>
                    <button type="submit">Сохранить статус</button>
                </form>
                <a href="{{ route('admin.order.show.create', $product) }}">Оформить через api</a>
            </div>
            <hr>
        @empty
            <div>
                <p>Что-то пошло не так и товаров нет в этом заказе</p>
                <p>Возможно произошол сбой на сайте и товары не сохранились</p>
                <p>Или юзеру удалось оформить заказ с пустой корзиной</p>
            </div>
        @endforelse
    </div>
@endsection
