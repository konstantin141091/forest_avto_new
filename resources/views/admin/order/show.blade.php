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
                <p>ID в магазине: {{ $product->product_id }}</p>
                <p>ID склада в магазине: {{ $product->offers_id }}</p>
                <p>Название склада в магазине: {{ $product->offers_name }}</p>
                <p>Название товара: {{ $product->name }}</p>
                <p>Бренд товара: {{ $product->brand_name }}</p>
                <p>Название магазина: {{ $product->shop_name }}</p>
                <p>Количество: {{ $product->quantity }}</p>
                <p>Цена за товар: {{ $product->offers_price }}</p>
                <p>Итого по этому товару: {{ $product->total }}</p>
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
