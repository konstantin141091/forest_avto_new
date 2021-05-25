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
        $pars_service = new ParseService();
//        берг products
        $berg_products = $pars_service->bergApi->getProductsWhitArticle($article);
        if (!empty($berg_products)) {
            $success = true;
        }
// rossko products
        $rossko_product = $pars_service->rosskoApi->getProductsWhitArticle($article);
        if (!empty($rossko_product)) {
            $success = true;
        }
// avtopiter products
        $avto_piter_product = $pars_service->avtoPiterApi->getProductsWhitArticle($article);
        if (!empty($rossko_product)) {
            $success = true;
        }

//        dd($avto_piter_product);
//        dd($rossko_product);
//        dd($berg_products);
        return view('products_search', [
            'berg_products' => $berg_products,
            'rossko_products' => $rossko_product,
            'avto_piter_products' => $avto_piter_product,

            'success' => $success,
        ]);
    }
}
