<?php


namespace App\Services;

use App\Http\Interfaces\IParser;
use GuzzleHttp\Client;
use App\Models\Product;

class BergAPI extends ParseService implements IParser
{
    private $api_key;
    private $base_url;
    private $products;

    public function __construct()
    {
        $this->api_key = env('BERG_API_KEY');
        $this->base_url = env('BERG_STOCK_REQUEST_URL');
    }

    public function getProductsWhitArticle(string $article, array $products) {
        try {
            $this->products = $products;
            $client = new Client();
            $response = $client->request('GET', $this->getUrlWhitArticle($article));
            $result = json_decode($response->getBody()->getContents(), true);

        } catch (\Exception $exception) {
            return $products;
            // если не удалось получить товары от api, то массив products не заполниться от этого сайта
        }

        if (!empty($products['resources'])) {
            $this->parseProducts($result, 'original');
        }
//        dd($this->products);
        return $this->products;
    }

    private function getUrlWhitArticle(string $article) {
        $url = $this->base_url.'?items[0][resource_article]='.$article.'&key='.$this->api_key;
        return $url;
    }

    private function parseProducts($products, string $type) {
        foreach ($products['resources'] as $value) {
            try {
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
                    $this->products[$type][mb_strtoupper($value['brand']['name'])][] = $product;
                }
            } catch (\Exception $exception) {
                // если модель продукта не создалась и не добавилась, то просто ничего не будет
            }
        }
    }
}
