<?php


namespace App\Services;

use App\Http\Interfaces\IParser;
use GuzzleHttp\Client;
use App\Models\Product;

class BergAPI implements IParser
{
    private $api_key;
    private $base_url;

    public function __construct()
    {
        $this->api_key = env('BERG_API_KEY');
        $this->base_url = env('BERG_STOCK_REQUEST_URL');
    }

    public function getProductsWhitArticle(string $article) {
        $client = new Client();
        $response = $client->request('GET', $this->getUrlWhitArticle($article));
        $products = json_decode($response->getBody()->getContents(), true);
//        dd($products);
        if (empty($products['resources'])) {
            return [];
        }
        $products = $this->parseProducts($products);
        return $products;
    }

    private function getUrlWhitArticle($article) {
        $url = $this->base_url.'?items[0][resource_article]='.$article.'&key='.$this->api_key;
        return $url;
    }

    private function parseProducts($products) {
        $response = array();
        foreach ($products['resources'] as $value) {
            $response[$value['brand']['name']] = [];
//            dd($response);
            foreach ($value['offers'] as $el) {
                $days =  $el['assured_period'] + 1;
                $product = new Product();
//            product data
                $product->fill($value);
                $product->product_id = $value['id'];
                $product->shop_name = 'berg';
//            brand data
                $product->brand_id = $value['brand']['id'];
                $product->brand_name = mb_strtoupper($value['brand']['name']);
//            offer data
                $product->offers_id = $el['warehouse']['id'];
                $product->offers_name = $el['warehouse']['name'];
                $product->offers_price = $el['price'];
                $product->offers_average_period = $el['average_period'];
                $product->offers_assured_period = (new \DateTime())
                    ->add(new \DateInterval("P{$days}D"))
                    ->format('d-m-Y');
                $product->offers_quantity = $el['quantity'];
//                array_push($response[$value['brand']['name']], $product);
                array_push($response[mb_strtoupper($value['brand']['name'])], $product);
            }
        }
        return $response;
    }
}
