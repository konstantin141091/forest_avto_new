<?php


namespace App\Services;

use GuzzleHttp\Client;

class PartsCatalogAPI
{
    private $api_key;
    private $base_url;
    private $client;

    public function __construct()
    {
        $this->api_key = env('PARTS_CATALOG_API_KEY');
        $this->base_url = env('PARTS_CATALOG_BASE_URL');
        $this->client = new Client();
    }

    private function getHeaders() {
        $headers = [
            'Accept'       => 'application/json',
            'Accept-Language' => 'ru',
            'Authorization' => $this->api_key,
        ];

        return $headers;
    }

    public function findCar($search) {
        $url = $this->base_url . 'car/info?q=' . $search;
        $request = $this->client->get($url, [
            \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
        ]);
        $cars = json_decode($request->getBody()->getContents(), true);
        if (empty($cars)) {
            return false;
        }
        return $cars;
    }

    public function carCategories($data) {
        try {
            $url = $this->base_url . 'catalogs/' . $data['catalogId'] . '/groups2/?carId=' . $data['carId']
                . '&criteria=' . $data['criteria'];
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $categories = json_decode($request->getBody()->getContents(), true);

            return $categories;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function carCatalog($data) {
//        $url = $this->base_url . 'catalogs/' . $data['catalogId'] . '/groups2/?carId=' . $data['carId']
//            . '&groupId=' . $data['groupId'] . '&criteria=' . $data['criteria'];
//        $request = $this->client->get($url, [
//            \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
//        ]);
//        $catalog = json_decode($request->getBody()->getContents(), true);
//        dd($catalog);
        try {
            $url = $this->base_url . 'catalogs/' . $data['catalogId'] . '/groups2/?carId=' . $data['carId']
                . '&groupId=' . $data['groupId'] . '&criteria=' . $data['criteria'];
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $catalog = json_decode($request->getBody()->getContents(), true);
            return $catalog;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function carCatalogParts($data) {
//        $url = $this->base_url . 'catalogs/' . $data['catalogId'] . '/parts2?carId=' . $data['carId'] . '&groupId=' .
//            $data['groupId'] . '&criteria=' . $data['criteria'];
//        $request = $this->client->get($url, [
//            \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
//        ]);
//        $parts = json_decode($request->getBody()->getContents(), true);
//        dd($parts);
        try {
            $url = $this->base_url . 'catalogs/' . $data['catalogId'] . '/parts2?carId=' . $data['carId'] . '&groupId=' .
                $data['groupId'] . '&criteria=' . $data['criteria'];
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $parts = json_decode($request->getBody()->getContents(), true);
            return $parts;
        } catch (\Exception $exception) {
            return false;
        }
    }

}
