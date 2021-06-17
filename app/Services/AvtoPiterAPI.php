<?php


namespace App\Services;

use App\Interfaces\IParser;
use App\Models\Product;

class AvtoPiterAPI implements IParser
{
    private $user_id;
    private $password;
    private $base_url;
    private $client;
    private $products;
    private $article;

    public function __construct()
    {
        $this->user_id = env('AVTOPITER_USER_ID');
        $this->password = env('AVTOPITER_PASSWORD');
        $this->base_url = env('AVTOPITER_BASE_URL');
    }

    public function getProductsWhitArticle(string $article, array $products) {
        $this->article = $article;
        $this->products = $products;
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
//        dd($result);
        if (!property_exists($result->FindCatalogResult, 'SearchCatalogModel')) {
            return [];
        }
        $this->parseProducts($result->FindCatalogResult->SearchCatalogModel);
//        dd($this->products);
        return $this->products;
    }

//    перебор данных ответа от апи по артиклу
    private function parseProducts($catalog_products) {
        if (is_array($catalog_products)) {
            foreach ($catalog_products as $value) {
                // поиск оригиналов
                $original = $this->client->GetPriceId(['ArticleId' => $value->ArticleId]);
//                dd($original);
                if (property_exists($original, 'GetPriceIdResult')) {
                    if (is_array($original->GetPriceIdResult->PriceSearchModel)) {
                        foreach ($original->GetPriceIdResult->PriceSearchModel as $product) {
                            $this->createProduct($product, 'original');
                        }
                    } else {
                        $product = $original->GetPriceIdResult->PriceSearchModel;
                        $this->createProduct($product, 'original');
                    }
                }

                // поиск аналогов
                $analogs = $this->client->GetPriceId(['ArticleId' => $value->ArticleId, 'SearchCross' => 1]);
                if (property_exists($analogs, 'GetPriceIdResult')) {
                    if (is_array($analogs->GetPriceIdResult->PriceSearchModel)) {
                        foreach ($analogs->GetPriceIdResult->PriceSearchModel as $product) {
                            $this->createProduct($product, 'analog');
                        }
                    } else {
                        $product = $analogs->GetPriceIdResult->PriceSearchModel;
                        $this->createProduct($product, 'analog');
                    }
                }

            }
        } else {
            // поиск оригиналов
            $original = $this->client->GetPriceId(['ArticleId' => $catalog_products->ArticleId, 'SearchCross' => 1]);
            if (property_exists($original, 'GetPriceIdResult')) {
                if (is_array($original->GetPriceIdResult->PriceSearchModel)) {
                    foreach ($original->GetPriceIdResult->PriceSearchModel as $product) {
                        $this->createProduct($product, 'original');
                    }
                } else {
                    $product = $original->GetPriceIdResult->PriceSearchModel;
                    $this->createProduct($product, 'original');
                }
            }
            // поиск аналогов
            $analogs = $this->client->GetPriceId(['ArticleId' => $catalog_products->ArticleId]);
            if (property_exists($analogs, 'GetPriceIdResult')) {
                if (is_array($analogs->GetPriceIdResult->PriceSearchModel)) {
                    foreach ($analogs->GetPriceIdResult->PriceSearchModel as $product) {
                        $this->createProduct($product, 'original');
                    }
                } else {
                    $product = $analogs->GetPriceIdResult->PriceSearchModel;
                    $this->createProduct($product, 'original');
                }
            }

        }

    }

//    метод создает модель продукта и пушит его в response который отдаст парсинг в контроллер
    private function createProduct($product, $type) {
        $productModel = new Product();
        $days = $product->NumberOfDaysSupply + 1;

        $productModel->product_id = $product->DetailUid;
        $productModel->article = $this->article;
        $productModel->name = $product->Name;
        $productModel->shop_name = 'avto_piter';
        $productModel->brand_name = mb_strtoupper($product->CatalogName);

        $productModel->offers_id = $product->SellerId;
        $productModel->offers_name = $product->NameStatus;
        $productModel->offers_price = $product->SalePrice;
        $productModel->offers_average_period = $product->NumberOfDaysSupply;
        $productModel->offers_assured_period = (new \DateTime())
            ->add(new \DateInterval("P{$days}D"))
            ->format('d-m-Y');
        $productModel->offers_quantity = $product->NumberOfAvailable;

        $this->products[$type][mb_strtoupper($product->CatalogName)][] = $productModel;
    }

    public function createOrder ($product) {
        $connect = [
            'wsdl' => 'http://service.autopiter.ru/v2/price?WSDL',
            'login' => [
                'UserID' => $this->user_id,
                'Password' => $this->password,
                'Save' => 'true',
            ],
        ];

        try{
            $this->client = new \SoapClient($connect['wsdl']);
            $this->client->Authorization($connect['login']);
            $result = $this->client->MakeOrderByItems([
                'Items' => [
                    0 => [
                        'DetailUid' => $product['DetailUid'],
                        'Comment' => $product['Сomment'],
                        'SalePrice' => $product['SalePrice'],
                        'Quantity' => $product['Quantity'],
                    ]
                ]
            ]);
            if ($result->MakeOrderByItemsResult->ResponseCodeItemCart->Code->ResponseCode === "4") {
                $product['SalePrice'] = $result->MakeOrderByItemsResult->ResponseCodeItemCart->Item->SalePrice;
                $this->createOrder($product);
            }
            if ($result->MakeOrderByItemsResult->ResponseCodeItemCart->Code->ResponseCode === "0") {
                return true;
            }
            return false;
        } catch (\Exception $exception) {
            return false;
        }

    }

}
