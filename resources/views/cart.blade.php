@extends('layouts.app')
@section('page-title', 'Корзина')

@section('content')
    <main>
        <div class="wrapper">
            <ul class="breadcrumbs">
                <li class="breadcrumbs__item"><a href="{{ route('index') }}" class="breadcrumbs__link">Главная</a></li>
                <li class="breadcrumbs__item">Корзина</li>
            </ul>
            <cart-page-component :order_url="'{{ route('order.index') }}'"></cart-page-component>
        </div>
    </main>
@endsection
