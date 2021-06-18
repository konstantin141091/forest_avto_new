<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function edit(Cart $cart, Request $request) {
//        dd($cart);
        $cart->fill($request->all());
        $cart->update();
        return back();
    }
}
