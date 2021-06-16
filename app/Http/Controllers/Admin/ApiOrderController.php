<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\BergAPI;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function createOrder(Request $request) {
//        dd($request->all());
        if ($request->shop_name === 'berg') {
            $begrApi = new BergAPI();
            $result = $begrApi->createOrder($request->all());
//            dd($result);
            if ($result) {
                dd('Заказ оформлен. Можно посмотреть его в учетке Берга');
            } else {
                dd('Что-то пошло не так, заказ не оформился. Возможно вы не заполнили все поля.');
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
