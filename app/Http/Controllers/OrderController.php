<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use Mockery\Exception;

class OrderController extends Controller
{
    public function index() {
        return view('checkout');
    }

    public function store(OrderRequest $request) {
        // TODO заменить тип Request это сейчас временно.
        $request->validated();

        // Проверка пустая ли корзина
        if (empty($request->cart)) {
            return response()->json(['error' => 'Корзина пустая.'], '422');
        }

        $session_id = session()->getId();

        // логика добавления корзины
        $cart = $request->cart;
        foreach ($cart as $value) {
            $checkCart = $this->checkCart($value);
            if ($checkCart) {
                session()->regenerate();
                return response()->json(['error' => 'Корзина с такой сессией уже есть. 
                Регенерю сессию и отправляю ошибку. Заказ не создан.'], '409');
            } else {
                $cart = new Cart();
                $cart->fill($value);
                $cart->session_id = $session_id;
                $cart->save();
            }
        }

        // логика создания заказа
        if ($this->checkOrder()) {
            session()->regenerate();
            return response()->json(['error' => 'Заказ с такой сессией уже есть.'], '409');
        } else {
            $order_form = $request->order;
            $order = new Order();
            $order->fill($order_form);
            $order->session_id = $session_id;
            $order->status = 'оформлен';

            if ($order_form['delivery_method'] === 'доставка') {
                $order->address = 'улица '. $order_form['address_street'] . ' ' . $order_form['address_house'] . ', кв '
                    . $order_form['address_flat'] . ', подъезд ' . $order_form['address_entrance'] . ', этаж ' . $order_form['address_floor'];
            }
            $order->save();
            session()->regenerate();
            return response()->json(['order' => $order], '201');
        }



//        try {
//
//        }catch (Exception $exception) {
//            return response()->json(['error' => 'Не удалось оформить заказ. Ошибка на сервере.'], '500');
//        }
    }
    private function checkOrder() {
        $value = Order::query()->where('session_id', '=', session()->getId())->first();
        if ($value) {
            return true;
        } else return false;
    }

    private function checkCart(array $cart) {
        $value = Cart::query()->where('session_id', '=', session()->getId())
            ->where('product_id', '=', $cart['product_id'])
            ->where('offers_id', '=', $cart['offers_id'])
            ->where('offers_price', '=', $cart['offers_price'])->first();
        if ($value) {
            return $value;
        } else return false;
    }
}
