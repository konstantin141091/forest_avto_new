<?php


namespace App\Services;

use App\Models\Car;
use GuzzleHttp\Client;

class LevamAPI
{
    private $api_key;
    private $base_url;
    private $vinMethod = 'VinFind';
    private $treeGet = 'TreeGet';
    private $cars = [];

    public function __construct()
    {
        $this->api_key = env('LEVAM_API_KEY');
        $this->base_url = env('LEVAM_BASE_URL');

    }

    public function findVin($vin) {
        $url = $this->base_url . $this->vinMethod . '?api_key=' . $this->api_key . '&vin=' . $vin;
        try {
            $client = new Client();
            $response = $client->request('GET', $url);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['models']) {
                foreach ($response['models'] as $model) {
                    $car = new Car();
                    $car->mark = $model['Brand'];
                    $car->model = $model['Vehicle Line'];
                    $car->ssd = $response['client']['ssd'];
                    $car->link = $model['link'];
                    array_push($this->cars, $car);
                }
            }

        } catch (\Exception $exception) {

        }

        return $this->cars;
    }

    public function treeGet($ssd, $link) {
        $url = $this->base_url . $this->treeGet . '?api_key=' . $this->api_key . '&link=' . $link . '&ssd=' . $ssd . '&lang=ru';
        try {
            $client = new Client();
            $response = $client->request('GET', $url);
            $response = json_decode($response->getBody()->getContents(), true);
            if ($response['error'] === '') {
                $car = new Car();
                $car->mark = $response['model_info']['Марка'];
                $car->model = $response['model_info']['Модельный Ряд'];
                $car->ssd = $ssd;
                $car->link = $link;
                $car->catalog = $response['tree'];
                return $car;
            } else return false;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
