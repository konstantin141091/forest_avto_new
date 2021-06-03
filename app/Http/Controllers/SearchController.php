<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Car;
use App\Services\LevamAPI;
use App\Services\ParseService;
use App\Services\PartsCatalogAPI;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function artikul(SearchRequest $request) {
        $request->flash();
        $request->validated();
        $article = $request->artikul;
        $success = false;
        $products = [];
        $pars_service = new ParseService();

//        берг products
        $berg_products = $pars_service->bergApi->getProductsWhitArticle($article);
//        dd($berg_products);
        if (!empty($berg_products)) {
            foreach ($berg_products as $brand => $value) {
                if ($value && !empty($value)) {
                    if (!array_key_exists($brand, $products)) {
                        $products[$brand] = [];
                    }
                    foreach ($value as $el) {
                        array_push($products[$brand], $el);
                    }
                }
            }
            $success = true;
//            dd($products);
        }
// rossko products
        $rossko_products = $pars_service->rosskoApi->getProductsWhitArticle($article);
//        dd($rossko_products);
        if (!empty($rossko_products)) {
            foreach ($rossko_products as $brand => $value) {
                if (!array_key_exists($brand, $products)) {
                    $products[$brand] = [];
                }
                foreach ($value as $el) {
                    array_push($products[$brand], $el);
                }
            }
            $success = true;
//            dd($products);
        }
// avtopiter products
        $avto_piter_products = $pars_service->avtoPiterApi->getProductsWhitArticle($article);
//        dd($avto_piter_products);
        if (!empty($avto_piter_products)) {
            foreach ($avto_piter_products as $brand => $value) {
                if (!array_key_exists($brand, $products)) {
                    $products[$brand] = [];
                }
                foreach ($value as $el) {
                    array_push($products[$brand], $el);
                }
            }
            $success = true;
        }
//        dd($products);
        return view('search.products', [
            'products' => $products,
            'success' => $success,
        ]);
    }

    public function findCar(Request $request) {
        $request->flash();
        $success = false;
        $search = $request->search;
        $partsCatalog = new PartsCatalogAPI();
        $cars = $partsCatalog->findCar($search);

        if ($cars) {
            $success = true;
        }
//        dd($cars);
        return view('search.cars', [
            'cars' => $cars,
            'success' => $success,
        ]);
    }

    public function carCategories(Request $request) {
        $success = false;
        $data = [
            'catalogId' => $request->catalogId,
            'carId' => $request->carId,
            'criteria' => $request->criteria,
            'frame' => $request->frame,
            'vin' => $request->vin,
        ];
        $partsCatalog = new PartsCatalogAPI();
        $categories = $partsCatalog->carCategories($data);
        if ($categories) {
            $success = true;
        }
//        dd($catalog);
        return view('search.car_categories', [
            'categories' => $categories,
            'data' => $data,
            'success' => $success,
        ]);
    }

    public function carCatalog(Request $request) {
        $success = false;
        $data = [
            'catalogId' => $request->catalogId,
            'carId' => $request->carId,
            'criteria' => $request->criteria,
            'groupId' => $request->groupId,
        ];
        $partsCatalog = new PartsCatalogAPI();
        $catalog = $partsCatalog->carCatalog($data);
        if ($catalog) {
            $success = true;
        }
//        dd($catalog);
        return view('search.car_catalog', [
            'catalog' => $catalog,
            'data' => $data,
            'success' => $success,
        ]);
    }

    public function carCatalogParts(Request $request) {
        $success = false;
        $data = [
            'catalogId' => $request->catalogId,
            'carId' => $request->carId,
            'criteria' => $request->criteria,
            'groupId' => $request->groupId,
        ];
        $partsCatalog = new PartsCatalogAPI();
        $parts = $partsCatalog->carCatalogParts($data);
//        dd($parts);
        if ($parts) {
            $success = true;
        }
        return view('search.car_catalog_parts', [
            'parts' => $parts,
            'success' => $success,
        ]);
    }

}
