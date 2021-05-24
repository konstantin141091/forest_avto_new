<?php


namespace App\Services;


use App\Models\Product;

class AvtoPiterAPI
{
    private $user_id;
    private $password;
    private $base_url;
    private $client;
    private $response = array();
    private $article;

    public function __construct()
    {
        $this->user_id = env('AVTOPITER_USER_ID');
        $this->password = env('AVTOPITER_PASSWORD');
        $this->base_url = env('AVTOPITER_BASE_URL');
    }

    public function getProductsWhitArticle(string $article) {
        $this->article = $article;
        $connect = [
            'wsdl' => 'http://service.autopiter.ru/v2/price?WSDL',
            'login' => [
                'UserID' => $this->user_id,
                'Password' => $this->password,
                'Save' => 'true',
                ],
        ];
        $this->client = new \SoapClient($connect['wsdl']);
        $this->client->Authorization($connect['login']);
        $result = $this->client->FindCatalog(['Number' => $article]);
        if (!property_exists($result->FindCatalogResult, 'SearchCatalogModel')) {
            return [];
        }
//        dd($result->FindCatalogResult->SearchCatalogModel);
        $this->parseProducts($result->FindCatalogResult->SearchCatalogModel);

        return $this->response;
    }

    private function parseProducts($catalog_products) {
        foreach ($catalog_products as $value) {
            $products = $this->client->GetPriceId(['ArticleId' => $value->ArticleId]);
            if (property_exists($products, 'GetPriceIdResult')) {
                foreach ($products->GetPriceIdResult->PriceSearchModel as $product) {
                    $productModel = new Product();
                    $days = $product->NumberOfDaysSupply + 1;

                    $productModel->product_id = $product->DetailUid;
                    $productModel->article = $this->article;
                    $productModel->name = $product->Name;
                    $productModel->shop_name = 'авто питер';
                    $productModel->brand_name = $product->CatalogName;

                    $productModel->offers_id = $product->SellerId;
                    $productModel->offers_name = $product->NameStatus;
                    $productModel->offers_price = $product->SalePrice;
                    $productModel->offers_average_period = $product->NumberOfDaysSupply;
                    $productModel->offers_assured_period = (new \DateTime())
                        ->add(new \DateInterval("P{$days}D"))
                        ->format('d-m-Y');
                    $productModel->offers_quantity = $product->NumberOfAvailable;

                    $this->response[$product->CatalogName][] = $productModel;
                }
            }
        }
    }

}
