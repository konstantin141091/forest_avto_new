@extends('layouts.app')
@section('page-title', 'Вход в админ панель')

@section('content')
    <div class="wrapper">
        <h1>Оформление заказа</h1>
        <checkout-page-component :url_index="'{{ route('index') }}'"></checkout-page-component>
    </div>
@endsection
