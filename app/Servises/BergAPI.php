<?php


namespace App\Servises;

use GuzzleHttp\Client;
use App\Models\Product;

class BergAPI
{
    private $artikul;
    private $api_key;
    private $base_url;

    public function __construct(string $artikul)
    {
        $this->artikul = $artikul;
        $this->api_key = env('BERG_API_KEY');
        $this->base_url = env('BERG_STOCK_REQUEST_URL');
    }

    public function getProductsWhitArtikul() {
        $client = new Client();
        $response = $client->request('GET', $this->getUrlWhitArtikul());
        $products = json_decode($response->getBody()->getContents(), true);
        if (empty($products['resources'])) {
            return [];
        }
        $products = $this->parseProducts($products);
        return $products;
    }

    private function getUrlWhitArtikul() {
        $url = $this->base_url.'?items[0][resource_article]='.$this->artikul.'&key='.$this->api_key;
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
//            brand data
                $product->brand_id = $value['brand']['id'];
                $product->brand_name = $value['brand']['name'];
//            offer data
                $product->offers_id = $el['warehouse']['id'];
                $product->offers_name = $el['warehouse']['name'];
                $product->offers_type = $el['warehouse']['type'];
                $product->offers_price = $el['price'];
                $product->offers_average_period = $el['average_period'];
                $product->offers_assured_period = (new \DateTime())
                    ->add(new \DateInterval("P{$days}D"))
                    ->format('d-m-Y');
                $product->offers_reliability = $el['reliability'];
                $product->offers_is_transit = $el['is_transit'];
                $product->offers_quantity = $el['quantity'];
                $product->offers_available_more = $el['available_more'];
                $product->offers_multiplication_factor = $el['multiplication_factor'];
                $product->offers_delivery_type = $el['delivery_type'];
                $product->shop_name = 'berg';
                array_push($response[$value['brand']['name']], $product);
            }
        }
        return $response;
    }
}
