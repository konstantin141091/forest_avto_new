<?php


namespace App\Services;

use App\Interfaces\IParser;
use GuzzleHttp\Client;
use App\Models\Product;
use Illuminate\Support\Facades\Date;

class BergAPI extends ParseService implements IParser
{
    private $api_key;
    private $base_url;
    private $products;

    public function __construct()
    {
        $this->api_key = env('BERG_API_KEY');
        $this->base_url = env('BERG_BASE_URL');
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

//        dd($result);

        if (!empty($result['resources'])) {
            $this->parseProducts($result, 'original');
        }
//        dd($this->products);
        return $this->products;
    }

    private function getUrlWhitArticle(string $article) {
        $url = $this->base_url . 'ordering/get_stock.json' . '?items[0][resource_article]='.$article.'&key='.$this->api_key;
        return $url;
    }

    private function parseProducts($products, string $type) {
//        dd($products);
        foreach ($products['resources'] as $value) {
            try {
                $response[$value['brand']['name']] = [];
//            перебираю скдады
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

    public function createOrder($product) {
//        dd($product);
        try {
            $url = $this->base_url . 'ordering/place_order.json' . '?key=' . $this->api_key;
            $date = new \DateTime($product['dispatch_at']);
            $headers = [
                'Content-Type' => 'application/json',

            ];
            $client = new Client();
            $request = $client->post($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $headers,
                \GuzzleHttp\RequestOptions::JSON => [
                    "force" => 1,
                    "order" => [
                        "is_test" => 1,
                        "dispatch_type" => $product['dispatch_type'],
                        "dispatch_time" => 1,
                        "dispatch_at" => $date->format('Y-m-d'),
                        "person" => $product['person'],
                        "phone" => $product['phone'],
                        "comment" => $product['comment_order'],
                        "shipment_address" => $product['shipment_address'],
                        "items" => [
                            0 => [
                                "resource_id" => $product['resource_id'],
                                "warehouse_id" => $product['warehouse_id'],
                                "quantity" => $product['quantity'],
                                "comment" => $product['comment_product']
                            ]
                        ]

                    ]
                ]
            ]);
            $answer = json_decode($request->getBody()->getContents(), true);
            return $answer;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
