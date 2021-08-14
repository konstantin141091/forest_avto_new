<?php


namespace App\Services;

use GuzzleHttp\Client;

class AvtoCatalog
{
    private $api_key;
    private $base_url;
    private $client;

    public function __construct()
    {
        $this->api_key = env('AVTO_CATALOG_API_KEY');
        $this->base_url = env('AVTO_CATALOG_BASE_URL');
        $this->client = new Client();
    }

    private function getHeaders() {
        $headers = [
//            'Accept'       => 'application/json',
//            'Accept-Language' => 'ru',
            'Authorization' => $this->api_key,
        ];

        return $headers;
    }

    public function getCar(string $search) {
        $url = $this->base_url . 'catalogs/search2?text=' . $search;

        try {
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $cars = json_decode($request->getBody()->getContents(), true);
            if (empty($cars)) {
                return false;
            }
            return $cars;

        } catch (\Exception $exception) {
            return false;
        }
    }

    public function carCategories(array $data) {
        $url = $this->base_url .  'catalogs/' . $data['type'] . '/' . $data['mark'] . '/' . $data['model'] . '/' . $data['modification'];
        try {
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $categories = json_decode($request->getBody()->getContents(), true);
            if (empty($categories)) {
                return false;
            }
            return $categories;

        } catch (\Exception $exception) {
            return false;
        }
    }

    public function carCatalog(array $data) {
        $url = $this->base_url .  'catalogs/' . $data['type'] . '/' . $data['mark'] . '/' . $data['model'] . '/' .
            $data['modification'] . '/' . $data['groupId'];
        try {
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $catalog = json_decode($request->getBody()->getContents(), true);
            if (empty($catalog)) {
                return false;
            }
            return $catalog;

        } catch (\Exception $exception) {
            return false;
        }
    }

    public function carCatalogParts(array $data) {
        $url = $this->base_url .  'catalogs/' . $data['type'] . '/' . $data['mark'] . '/' . $data['model'] . '/' .
            $data['modification'] . '/' . $data['groupId'] . '/' . $data['subGroup'];

        try {
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $parts = json_decode($request->getBody()->getContents(), true);
            if (empty($parts)) {
                return false;
            }
            return $parts;

        } catch (\Exception $exception) {
            return false;
        }


//        $url2 = $this->base_url .  'catalogs/' . $data['type'] . '/' . $data['mark'] . '/' . $data['model'] . '/' .
//            $data['modification'] . '/MfCfmoAwMDI/IzLwn5qAMDAy8J-agTQ3OTY3NkI';
//        dd($url);

//        $request = $this->client->get($url, [
//            \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
//        ]);
//        $parts = json_decode($request->getBody()->getContents(), true);
//        dd($parts);

    }

}
