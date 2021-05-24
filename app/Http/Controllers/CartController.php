<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Mockery\Exception;

class CartController extends Controller
{
    public function index() {
        return view('cart');
    }
    public function store(Request $request) {
        try {
            $cart = $request->all();
            $session_id = session()->getId();
            foreach ($cart as $value) {
                $checkCart = $this->checkCart($value);
                if ($checkCart) {
                    $checkCart->fill($value);
                    $checkCart->update();
                } else {
                    $cart = new Cart();
                    $cart->fill($value);
                    $cart->session_id = $session_id;
                    $cart->save();
                }
            }
            return response()->json(['answer' => 'success'], '201');
        }catch (Exception $exception) {
            return response()->json(['answer' => 'error'], '500');
        }
    }

    private function checkCart(array $cart) {
        $value = Cart::query()->where('session_id', '=', session()->getId())
            ->where('id', '=', $cart['id'])
            ->where('offers_id', '=', $cart['offers_id'])
            ->where('offers_price', '=', $cart['offers_price'])->first();
        if ($value) {
            return $value;
        } else return false;
    }
}
