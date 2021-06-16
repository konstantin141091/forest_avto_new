<?php


namespace App\Services;

use App\Interfaces\IParser;
use App\Models\Product;

class RosskoAPI extends ParseService implements IParser
{
    private $api_key_1;
    private $api_key_2;
    private $base_url;
    protected $products;
    private $article;
    private $connect;
    private $param;

    public function __construct()
    {
        $this->api_key_1 = env('ROSSKO_API_KEY_1');
        $this->api_key_2 = env('ROSSKO_API_KEY_2');
        $this->base_url = env('ROSSKO_BASE_URL');
        $this->connect = [
            'wsdl'    => $this->base_url . 'GetSearch',
            'options' => [
                'connection_timeout' => 1,
                'trace' => true
            ]
        ];
        $this->param = [
            'KEY1' => $this->api_key_1,
            'KEY2' => $this->api_key_2,
            'text' => '',
            'delivery_id' => '000000002',
            'address_id'  => '62419'
        ];
    }

    public function getProductsWhitArticle(string $article, array $products) {
        $this->article = $article;
        $this->param['text'] = $this->article;
        $this->products = $products;
        try {
            $query = new \SoapClient($this->connect['wsdl'], $this->connect['options']);
            $result = $query->GetSearch($this->param);
        } catch (\Exception $exception) {
            return $products;
            // если не удалось получить товары от api, то массив products не заполниться от этого сайта
        }
//        dd($result);
        if ($result->SearchResult->success === true) {
            $this->parseProducts($result->SearchResult->PartsList->Part);
        }
//        dd($this->products);
        return $this->products;
    }

    private function parseProducts($products) {
        // начинаем перебор товаров
        foreach ($products as $product) {
            // если у товара сразу есть stocks, значит это оригинал, который есть в наличии, поэтому создаем модель товара с пометкой original
            if (property_exists($product, 'stocks')) {
                $this->createProduct($product, 'original');
            }
            // если у товара сразу есть crosses, значит это этого товара есть аналоги, перебираем их
            if (property_exists($product, 'crosses')) {
                foreach ($product->crosses->Part as $product_crosses) {
                    // если в crosses один товар, то это объект, если более одного, то это уже массив, поэтому проверка на массив
                    if (is_array($product_crosses)) {
                        foreach ($product_crosses as $product_crosses_value) {
                            // если у товара сразу есть stocks, значит есть в наличии, поэтому создаем модель товара
                            if (property_exists($product_crosses_value, 'stocks')) {
                                $this->createProduct($product_crosses_value, 'analog');
                            }
                        }
                    } else {
                        // если у товара сразу есть stocks, значит есть в наличии, поэтому создаем модель товара
                        if (property_exists($product_crosses, 'stocks')) {
                            $this->createProduct($product_crosses, 'analog');
                        }
                    }
                }
            }
        }
    }

    private function createProduct($product, $type) {
        // stocks если там один элемент, то это объект, если более одного, то это массив
        // поэтому ветвление для проверки этого
        if (is_array($product->stocks->stock)) {
            foreach ($product->stocks->stock as $el) {
                $productModel = new Product();
                $days =  $el->delivery + 1;

                $productModel->product_id = $product->guid;
                if ($product->partnumber) {
                    $productModel->article = $product->partnumber;
                } else {
                    $productModel->article = $this->article;
                }
                $productModel->name = $product->name;
                $productModel->shop_name = 'росско';
                $productModel->partnumber = $product->partnumber;
                $productModel->brand_name = mb_strtoupper($product->brand);

                $productModel->offers_id = $el->id;
                $productModel->offers_name = $el->description;
                $productModel->offers_price = $el->price;
                $productModel->offers_average_period = $el->delivery;
                $productModel->offers_assured_period = (new \DateTime())
                    ->add(new \DateInterval("P{$days}D"))
                    ->format('d-m-Y');
                $productModel->offers_quantity = $el->count;
                $this->products[$type][mb_strtoupper($product->brand)][] = $productModel;
            }
        } else {
            $productModel = new Product();
            $days =  $product->stocks->stock->delivery + 1;
            // по guid можно на сайте росско найти этот товар
            $productModel->product_id = $product->guid;
            if ($product->partnumber) {
                $productModel->article = $product->partnumber;
            } else {
                $productModel->article = $this->article;
            }
            $productModel->name = $product->name;
            $productModel->shop_name = 'росско';
            $productModel->partnumber = $product->partnumber;
            $productModel->brand_name = mb_strtoupper($product->brand);

            $productModel->offers_id = $product->stocks->stock->id;
            $productModel->offers_name = $product->stocks->stock->description;
            $productModel->offers_price = $product->stocks->stock->price;
            $productModel->offers_average_period = $product->stocks->stock->delivery;
            $productModel->offers_assured_period = (new \DateTime())
                ->add(new \DateInterval("P{$days}D"))
                ->format('d-m-Y');
            $productModel->offers_quantity = $product->stocks->stock->count;
            $this->products[$type][mb_strtoupper($product->brand)][] = $productModel;
        }
    }
}
