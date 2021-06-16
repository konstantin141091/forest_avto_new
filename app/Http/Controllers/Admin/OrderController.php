<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all()->sortByDesc('created_at');

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
}
