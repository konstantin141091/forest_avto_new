<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\ParseService;

class SearchController extends Controller
{
    public function index(SearchRequest $request) {
        $request->flash();
        $request->validated();
        $article = $request->artikul;
        $success = false;

//        берг products
        $pars_service = new ParseService();
        $berg_products = $pars_service->bergApi->getProductsWhitArticle($article);
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
