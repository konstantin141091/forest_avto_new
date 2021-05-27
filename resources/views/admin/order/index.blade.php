@extends('layouts.app_admin')
@section('page-title', 'Админ-панель сайта | Заказы')

@section('content')
    <div class="wrapper">
        <h1>Админка сайта</h1>
        <h2>формленные заказы</h2>
        @forelse($orders as $order)
            <div>
                <p>Номер заказа: {{ $order->id }}</p>
                <p>Статус заказа: {{ $order->status }}</p>
                <p>Имя заказчика: {{ $order->name }}</p>
                <p>Сумма заказа: {{ $order->total_price }}</p>
                <p>Дата оформления: {{ $order->created_at }}</p>
                <a href="{{ route('admin.order.show', $order) }}">Посмотреть заказ</a>
            </div>
            <hr>
        @empty
           <div>
               <p>Заказов нет</p>
           </div>
        @endforelse
    </div>
@endsection
