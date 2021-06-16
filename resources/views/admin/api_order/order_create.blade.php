@extends('layouts.app_admin')
@section('page-title', 'Админ-панель сайта | Просмотр заказа')

@section('content')
    <div class="wrapper">
        <h1>Админка сайта</h1>
        <h2>Заказать через api</h2>
{{--        <div>--}}
{{--            <p>Номер заказа: {{ $order->id }}</p>--}}
{{--            <p>Статус заказа: {{ $order->status }}</p>--}}
{{--            <p>Имя заказчика: {{ $order->name }}</p>--}}
{{--            <p>Сумма заказа: {{ $order->total_price }}</p>--}}
{{--            <p>Дата оформления: {{ $order->created_at }}</p>--}}
{{--        </div>--}}
{{--        <hr>--}}
{{--        @forelse($products as $product)--}}
            <div>
                <p>Артикул товара: {{ $product->article }}</p>
                <p>ID в магазине: {{ $product->product_id }}</p>
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
{{--                <a href="{{ route('admin.order.show.create', $product) }}">Оформить через api</a>--}}
                <form action="{{ route('admin.order.create') }}" method="POST">
                    <h2>Форма оформления заказа через api</h2>
                    <p>Этот заказ после оформления появится в личном кабинете Berg</p>
                    @csrf
                    <input type="hidden" name="resource_id" value="{{ $product->product_id }}">
                    <input type="hidden" name="warehouse_id" value="{{ $product->offers_id }}">
                    <input type="hidden" name="quantity" value="{{ $product->quantity }}">
                    <input type="hidden" name="shop_name" value="{{ $product->shop_name }}">
                    <input type="hidden" name="dispatch_at" value="{{ $product->offers_assured_period }}">

                    <div>
                        <label for="payment_type">Тип оплаты</label>
                        <select name="payment_type" id="payment_type">
                            <option disabled>Выберите тип оплаты</option>
                            <option selected value="1">Наличный расчет</option>
                            <option value="2">Безналичный расчет</option>
                        </select>
                    </div>

                    <div>
                        <label for="dispatch_type">Тип отгрузки</label>
                        <select name="dispatch_type" id="dispatch_type">
                            <option disabled>Выберите тип отгрузки</option>
                            <option value="2">Самовывоз</option>
                            <option selected value="3">Доставка</option>
                            <option value="60580">Срочная доставка</option>
                        </select>
                    </div>

                    <div>
                        <label for="person">Имя заказчика</label>
                        <input type="text" name="person" id="person" value="{{ old('person') }}">
                    </div>

                    <div>
                        <label for="phone">Телефон</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                    </div>

                    <div>
                        <label for="comment_order">Комметарий к заказу</label>
                        <input type="text" name="comment_order" id="comment_order" value="{{ old('comment_order') }}">
                    </div>

                    <div>
                        <label for="shipment_address">Адресс доставки</label>
                        <input type="text" name="shipment_address" id="shipment_address" value="{{ old('shipment_address') }}">
                    </div>

                    <div>
                        <label for="quantity">Заказываемое количество</label>
                        <p>На складе: {{ $product->offers_quantity }}</p>
                        <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}">
                    </div>

                    <div>
                        <label for="delivery_type">Тип доставки</label>
                        <select name="delivery_type" id="delivery_type">
                            <option disabled>Выберите тип доставки</option>
                            <option selected value="1">Обычная доставка</option>
                            <option value="2">Авиадоставка</option>
                        </select>
                    </div>

                    <div>
                        <label for="comment_product">Комметарий к товару</label>
                        <input type="text" name="comment_product" id="comment_product" value="{{ old('comment_product') }}">
                    </div>

                    <button type="submit">Оформить заказать</button>
                </form>

            </div>
            <hr>
{{--        @empty--}}
{{--            <div>--}}
{{--                <p>Что-то пошло не так и товаров нет в этом заказе</p>--}}
{{--                <p>Возможно произошол сбой на сайте и товары не сохранились</p>--}}
{{--                <p>Или юзеру удалось оформить заказ с пустой корзиной</p>--}}
{{--            </div>--}}
{{--        @endforelse--}}
    </div>
@endsection
