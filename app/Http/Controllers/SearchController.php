<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Servises\BergAPI;

class SearchController extends Controller
{
    public function index(SearchRequest $request) {
        $request->flash();
        $request->validated();
        $artikul = $request->artikul;
        $success = false;

//        берг products
        $berg_api = new BergAPI();
        $berg_products = $berg_api->getProductsWhitArtikul($artikul);
        if (!empty($berg_products)) {
            $success = true;
        }

//        dd($berg_products);
        return view('products_search', [
            'berg_products' => $berg_products,

            'success' => $success,
        ]);
    }
}
