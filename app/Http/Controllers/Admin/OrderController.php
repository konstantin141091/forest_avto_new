<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        if ($request->sort) {
            $orders = $this->indexSort($request->sort);
        } else {
            $orders = Order::orderByDesc('created_at')->paginate(20);
        }

        return view('admin.order.index',
            [
                'orders' => $orders
            ]);
    }

    public function show(Order $order) {
        $products = Cart::all()->where('session_id', '=', $order->session_id);
//        dd($products);
        return view('admin.order.show', [
            'order' => $order,
            'products' => $products
        ]);
    }

    public function edit(Order $order, Request $request) {
        $order->fill($request->all());
        $order->update();
        return back();
    }

    private function indexSort($value) {
        $orders = null;
        switch ($value) {
            case 'date_up' :
                $orders = Order::orderByDesc('created_at')->paginate(20);
                break;
            case  'date_down' :
                $orders = Order::orderBy('created_at')->paginate(20);
                break;
            case  'total_up' :
                $orders = Order::orderByDesc('total_price')->paginate(20);
                break;
            case  'total_down' :
                $orders = Order::orderBy('total_price')->paginate(20);
                break;
            case  'status_new' :
                $orders = Order::query()->where('status', '=', 'оформлен')->orderByDesc('created_at')->paginate(20);
                break;
            case  'status_work' :
                $orders = Order::query()->where('status', '=', 'в работе')->orderByDesc('created_at')->paginate(20);
                break;
            case  'status_finish' :
                $orders = Order::query()->where('status', '=', 'выполнен')->orderByDesc('created_at')->paginate(20);
                break;
        }
//        dd($orders);
        return $orders;
    }
}
