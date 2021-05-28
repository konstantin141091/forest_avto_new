@extends('layouts.app_without_footer')
@section('page-title', 'Оформление заказа')

@section('content')
    <div class="order-page">
        <div class="loader-wrapper">
            <loader-component></loader-component>
        </div>
        <div class="wrapper">
            <div class="order-page__body">
                <main class="order-page-main">
                    <div class="page-title-block">
                        <h1 class="page-title">Оформление заказа</h1>
                    </div>
                    <checkout-form ref="checkoutForm"></checkout-form>
                </main>
                <cart-list-for-checkout :url_index="'{{ route('index') }}'"></cart-list-for-checkout>
            </div>
        </div>
    </div>
@endsection
