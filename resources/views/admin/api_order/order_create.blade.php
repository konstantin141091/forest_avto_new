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
                <p>
                    ID в магазине: {{ $product->product_id }}
                    @if($product->shop_name === 'rossko')
                          (на сайте Росско этот товар можно найти по этому id)
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

                @if($product->shop_name === 'berg')
                    <form action="{{ route('admin.order.create', $product) }}" method="POST">
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
                @endif

                @if($product->shop_name === 'avto_piter')
                    <form action="{{ route('admin.order.create', $product) }}" method="POST">
                        <h2>Форма оформления товара в корзину через api</h2>
                        <p>Этот товар после оформления появится в корзине АвтоПитер</p>
                        @csrf
                        <input type="hidden" name="DetailUid" value="{{ $product->product_id }}">
                        <input type="hidden" name="SalePrice" value="{{ $product->offers_price }}">
                        <input type="hidden" name="shop_name" value="{{ $product->shop_name }}">

                        <div>
                            <label for="Сomment">Комментарий</label>
                            <input type="text" name="Сomment" id="Сomment" value="{{ old('comment') }}">
                        </div>

                        <div>
                            <label for="Quantity">Заказаное количество</label>
                            <input type="number" name="Quantity" id="Quantity" value="{{ $product->quantity }}">
                        </div>

                        <button type="submit">Добавить в корзину</button>
                    </form>
                @endif

                @if($product->shop_name === 'rossko')
                    <form action="{{ route('admin.order.create', $product) }}" method="POST">
                        <h2>Форма оформления заказа через api</h2>
                        <p>Этот заказ после оформления появится в личном кабинете Росско</p>
                        @csrf
                        <input type="hidden" name="partnumber" value="{{ $product->article }}">
                        <input type="hidden" name="brand" value="{{ $product->brand_name }}">
                        <input type="hidden" name="stock" value="{{ $product->offers_id }}">
                        <input type="hidden" name="shop_name" value="{{ $product->shop_name }}">

                        <div>
                            <label for="payment_id">Способ оплаты</label>
                            <select name="payment_id" id="payment_id">
                                <option disabled>Выберите тип оплаты</option>
                                <option value="1">Оплата банковским платежом</option>
                                <option selected value="2">Оплата наличными при получении товара</option>
                            </select>
                        </div>

                        <div>
                            <label for="comment">Комментарий к заказу</label>
                            <input type="text" name="comment" id="comment" value="{{ old('comment') }}">
                        </div>

                        <div>
                            <label for="name">Имя</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}">
                        </div>

                        <div>
                            <label for="phone">Телефон</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                        </div>

                        <div>
                            <label for="count">Заказаное количество</label>
                            <input type="number" name="count" id="count" value="{{ $product->quantity }}">
                        </div>

                        <div>
                            <label for="comment">Комментарий к детали</label>
                            <input type="text" name="comment_product" id="comment_product" value="{{ old('comment_product') }}">
                        </div>

                        <button type="submit">Оформить заказ</button>
                    </form>
                @endif

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
