<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Services\AvtoCatalog;
use App\Services\ParseService;
use App\Services\PartsCatalogAPI;
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

        // avtopiter products
        $products = $pars_service->avtoPiterApi->getProductsWhitArticle($article, $products);

        // berg products
        $products = $pars_service->bergApi->getProductsWhitArticle($article, $products);
//
//        // rossko products
        $products = $pars_service->rosskoApi->getProductsWhitArticle($article, $products);
//        dd($products);

        if(!empty($products)) {
            $success = true;
        }
//        dd($products);

        return view('search.products', [
            'products' => $products,
            'article' => $article,
            'success' => $success,
        ]);
    }

    public function findCar(Request $request) {
        $request->flash();
        $success = false;
        $search = $request->search;

        // новая апи
        $avtoCatalog = new AvtoCatalog();
        $cars = $avtoCatalog->getCar($search);

        // старая апи
//        $partsCatalog = new PartsCatalogAPI();
//        $cars = $partsCatalog->findCar($search);

        if ($cars) {
            $success = true;
        }
//        dd($cars);
        return view('search.cars', [
            'cars' => $cars['vins'],
            'success' => $success,
        ]);
    }

    public function carCategories(Request $request) {
        $success = false;

        // старая апи
//        $data = [
//            'catalogId' => $request->catalogId,
//            'carId' => $request->carId,
//            'criteria' => $request->criteria,
//            'frame' => $request->frame,
//            'vin' => $request->vin,
//        ];
//        $partsCatalog = new PartsCatalogAPI();
//        $categories = $partsCatalog->carCategories($data);

        // новая апи
        $data = [
            'modelId' => $request->modelId,
            'criteria' => $request->criteria,
            'frame' => $request->frame,
            'vin' => $request->vin,
            'type' => $request->type,
            'model' => $request->model,
            'modification' => $request->modification,
            'criteriaURI' => $request->criteriaURI,
            'mark' => $request->mark,
        ];
        $avtoCatalog = new AvtoCatalog();
        $categories = $avtoCatalog->carCategories($data);

        if ($categories) {
            $success = true;
        }
        return view('search.car_categories', [
            'categories' => $categories['groups'],
            'data' => $data,
            'success' => $success,
        ]);
    }

    public function carCatalog(Request $request) {
        $success = false;
        // старая апи
//        $data = [
//            'catalogId' => $request->catalogId,
//            'carId' => $request->carId,
//            'criteria' => $request->criteria,
//            'groupId' => $request->groupId,
//        ];
//        $partsCatalog = new PartsCatalogAPI();
//        $catalog = $partsCatalog->carCatalog($data);

        // новая апи

        $data = [
            'modelId' => $request->modelId,
            'criteria' => $request->criteria,
            'frame' => $request->frame,
            'vin' => $request->vin,
            'type' => $request->type,
            'model' => $request->model,
            'modification' => $request->modification,
            'criteriaURI' => $request->criteriaURI,
            'mark' => $request->mark,
            'groupId' => $request->groupId,
        ];
        $avtoCatalog = new AvtoCatalog();
        $catalog = $avtoCatalog->carCatalog($data);

        if ($catalog) {
            $success = true;
        }
//        dd($catalog);
        return view('search.car_catalog', [
            'catalog' => $catalog['groups'],
            'data' => $data,
            'success' => $success,
        ]);
    }

    public function carCatalogParts(Request $request) {
        $success = false;

        // старая апи
//        $data = [
//            'catalogId' => $request->catalogId,
//            'carId' => $request->carId,
//            'criteria' => $request->criteria,
//            'groupId' => $request->groupId,
//        ];
//        $partsCatalog = new PartsCatalogAPI();
//        $parts = $partsCatalog->carCatalogParts($data);

        // новая апи
        $data = [
            'modelId' => $request->modelId,
            'criteria' => $request->criteria,
            'frame' => $request->frame,
            'vin' => $request->vin,
            'type' => $request->type,
            'model' => $request->model,
            'modification' => $request->modification,
            'criteriaURI' => $request->criteriaURI,
            'mark' => $request->mark,
            'groupId' => $request->groupId,
            'subGroup' => $request->subGroup,
        ];

        $avtoCatalog = new AvtoCatalog();
        $parts = $avtoCatalog->carCatalogParts($data);
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
