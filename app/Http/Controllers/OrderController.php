<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
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
        try {
            if ($this->checkOrder()) {
                session()->regenerate();
                return response()->json(['error' => 'Заказ с такой сессией уже есть.'], '201');
            } else {
                $session_id = session()->getId();
                $order = new Order();
                $order->fill($request->all());
                $order->session_id = $session_id;
                $order->save();
                session()->regenerate();
                return response()->json(['order' => $order], '201');
            }
        }catch (Exception $exception) {
            return back()->with('error', 'Ошибка. Не удалось оформить заказ.');
        }
    }
    private function checkOrder() {
        $value = Order::query()->where('session_id', '=', session()->getId())->first();
        if ($value) {
            return true;
        } else return false;
    }
}
