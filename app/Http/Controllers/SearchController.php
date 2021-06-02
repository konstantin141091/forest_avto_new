<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Car;
use App\Services\LevamAPI;
use App\Services\ParseService;
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
        if (!empty($berg_products)) {
            foreach ($berg_products as $brand => $value) {
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
//        $products = json_encode($products);

        return view('search.products', [
            'products' => $products,
            'success' => $success,
        ]);
    }

    public function vin(Request $request) {
        $request->flash();
        $success = false;
        $vin = $request->vin;

        $client = new Client();
//        $res = $client->get('https://api.parts-catalogs.com/v1/ip/');
//        dd(json_decode($res->getBody()->getContents(), true));
        $url = 'https://api.parts-catalogs.com/v1/car/info?q=AT211-0080320';
        $request = $client->get($url, [
            \GuzzleHttp\RequestOptions::HEADERS => [
                'Accept'       => 'application/json',
                'Accept-Language' => 'ru',
                'Authorization' => 'OEM-API-9C409586-3F27-45D7-8E2E-306F7CA555FD'
            ]
        ]);
        dd($request);





//        $pars_service = new LevamAPI();
//        $cars = $pars_service->findVin($vin);
//        if (!empty($cars)) {
//            $success = true;
//        }
////        dd($cars);
//        return view('search.cars', [
//            'cars' => $cars,
//            'success' => $success,
//        ]);
    }

    public function frame(Request $request) {
//        $request->flash();
//        $vin = $request->frame;
//        $pars_service = new LevamAPI();
//        $catalog = $pars_service->findVin($vin);
//        dd($catalog);
    }

    public function car(Request $request) {
        $success = false;
        $ssd = $request->ssd;
        $link = $request->link;
        $pars_service = new LevamAPI();
        $car = $pars_service->treeGet($ssd, $link);
//        dd($car);
        if ($car) {
            $success = true;
        }

        return view('search.car_catalog', [
            'car' => $car,
            'success' => $success,
        ]);
    }
}
