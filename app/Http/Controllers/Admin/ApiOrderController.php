<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\AvtoPiterAPI;
use App\Services\BergAPI;
use App\Services\RosskoAPI;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function createOrder(Cart $cart, Request $request) {
//        dd($request->all());
        if ($request->shop_name === 'berg') {
            $begrApi = new BergAPI();
            $result = $begrApi->createOrder($request->all());
//            dd($result);
            if ($result) {
                $cart->status = 'заказан через апи';
                $cart->update();
                dd('Заказ оформлен. Можно посмотреть его в учетке Берга.');
            } else {
                dd('Что-то пошло не так, заказ не оформился. Возможно вы не заполнили все поля.');
            }
        }

        if ($request->shop_name === 'avto_piter') {
            $avtoPiterApi = new AvtoPiterAPI();
            $result = $avtoPiterApi->createOrder($request->all());
            if ($result) {
                $cart->status = 'заказан через апи';
                $cart->update();
                dd('Товар добавлен в корзину. Можно посмотреть его в учетке Автопитера и там оформить заказ.');
            } else {
                dd('Что-то пошло не так, заказ не оформился. Возможно товара больше нет или нет подключения к апи автопитера.');
            }
        }

        if ($request->shop_name === 'rossko') {
            $rosskoApi = new RosskoAPI();
            $result = $rosskoApi->createOrder($request->all());
            if ($result) {
                $cart->status = 'заказан через апи';
                $cart->update();
                dd('Заказ оформлен. Можно посмотреть его в учетке Росско.');
            } else {
                dd('Что-то пошло не так, заказ не оформился. Возможно товара больше нет или нет подключения к апи росско.');
            }
        }
    }

    public function showCreateOrder(Cart $cart) {
//        dd($cart);
        return view('admin.api_order.order_create', [
            'product' => $cart,
        ]);
    }
}
