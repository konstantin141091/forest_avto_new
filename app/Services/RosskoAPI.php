<?php


namespace App\Services;

use App\Http\Interfaces\IParser;
use App\Models\Product;

class RosskoAPI implements IParser
{
    private $api_key_1;
    private $api_key_2;
    private $base_url;
    protected $response = array();
    private $article;

    public function __construct()
    {
        $this->api_key_1 = env('ROSSKO_API_KEY_1');
        $this->api_key_2 = env('ROSSKO_API_KEY_2');
        $this->base_url = env('ROSSKO_BASE_URL');
    }

    public function getProductsWhitArticle(string $article) {
        $this->article = $article;
        $connect = array(
            'wsdl'    => $this->base_url . 'GetSearch',
            'options' => array(
                'connection_timeout' => 1,
                'trace' => true
            )
        );
        $param = array(
            'KEY1' => $this->api_key_1,
            'KEY2' => $this->api_key_2,
            'text' => $article,
            'delivery_id' => '000000002',
            'address_id'  => '62419'
        );
        try {
            $query = new \SoapClient($connect['wsdl'], $connect['options']);
            $result = $query->GetSearch($param);
        } catch (\Exception $exception) {
            return [];
        }
        if ($result->SearchResult->success === false) {
            return [];
        }
        $this->parseProducts($result->SearchResult->PartsList->Part);
        return $this->response;
    }

    private function parseProducts($products) {
        // TODO перебирать crosses
        foreach ($products as $product) {
            if (property_exists($product, 'stocks')) {
                $this->createProduct($product);
            }
        }
    }

    private function createProduct($product) {

        if (is_array($product->stocks->stock)) {
            foreach ($product->stocks->stock as $el) {
                $productModel = new Product();
                $days =  $el->delivery + 1;

                $productModel->product_id = $product->guid;
                $productModel->article = $this->article;
                $productModel->name = $product->name;
                $productModel->shop_name = 'росско';
                $productModel->partnumber = $product->partnumber;
                $productModel->brand_name = $product->brand;

                $productModel->offers_id = $el->id;
                $productModel->offers_name = $el->description;
                $productModel->offers_price = $el->price;
                $productModel->offers_average_period = $el->delivery;
                $productModel->offers_assured_period = (new \DateTime())
                    ->add(new \DateInterval("P{$days}D"))
                    ->format('d-m-Y');
                $productModel->offers_quantity = $el->count;

                $this->response[$product->brand][] = $productModel;
            }
        } else {
            $productModel = new Product();
            $days =  $product->stocks->stock->delivery + 1;
            $productModel->product_id = $product->guid;
            $productModel->article = $this->article;
            $productModel->name = $product->name;
            $productModel->shop_name = 'росско';
            $productModel->partnumber = $product->partnumber;
            $productModel->brand_name = $product->brand;

            $productModel->offers_id = $product->stocks->stock->id;
            $productModel->offers_name = $product->stocks->stock->description;
            $productModel->offers_price = $product->stocks->stock->price;
            $productModel->offers_average_period = $product->stocks->stock->delivery;
            $productModel->offers_assured_period = (new \DateTime())
                ->add(new \DateInterval("P{$days}D"))
                ->format('d-m-Y');
            $productModel->offers_quantity = $product->stocks->stock->count;

            $this->response[$product->brand][] = $productModel;
        }
    }


}
