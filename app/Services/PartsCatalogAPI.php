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

        $car = file(__DIR__ . '/car.json');
//        dd($car[1]);
        $strin = implode('', $car);
//        dd($strin);

        $result = json_decode($strin, true);
        $result2 = [$result];
//        dd($result);
        return $result2;





        $url = $this->base_url . 'car/info?q=' . $search;
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

    public function carCategories($data) {
        $cat = file(__DIR__ . '/category.json');
        $strin = implode('', $cat);
        $result = json_decode($strin, true);
        $result2 = [$result];
//        dd($result);
        return $result;

//        $catalog = file(__DIR__ . 'subcategory.json');
//        $strin = implode('', $catalog);
//        $result = json_decode($strin, true);



        try {
            $url = $this->base_url . 'catalogs/' . $data['catalogId'] . '/groups2/?carId=' . $data['carId']
                . '&criteria=' . $data['criteria'];
            $request = $this->client->get($url, [
                \GuzzleHttp\RequestOptions::HEADERS => $this->getHeaders()
            ]);
            $categories = json_decode($request->getBody()->getContents(), true);
//            dd($categories);
            return $categories;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function carCatalog($data) {
        $cat = file(__DIR__ . '/subcategory.json');
        $strin = implode('', $cat);
        $result = json_decode($strin, true);
        $result2 = [$result];
//        dd($result);
        return $result;


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
        $cat = file(__DIR__ . '/parts.json');
        $strin = implode('', $cat);
        $result = json_decode($strin, true);
        $result2 = [$result];
//        dd($result);
        return $result;



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



// данные по AT211-0080320

//[
//  {
//      "title": "Corona PREMIO E - AT211-AEMEK",
//    "catalogId": "toyota",
//    "brand": "Toyota",
//    "modelId": "946fc87f2830e099776a0347d56ca2ee",
//    "carId": "99613b9cee5973e0a85c9a608c1ef3e2",
//    "criteria": "23@AT211-0080320<FC17>4M7",
//    "vin": "",
//    "frame": "AT211-0080320",
//    "modelName": "Corona",
//    "source": "",
//    "description": "",
//    "optionCodes": [],
//    "parameters": [
//      {
//          "key": "grade_code",
//        "name": "Модификация",
//        "value": "AT211-AEMEK",
//        "idx": ""
//      },
//      {
//          "key": "engine_code",
//        "name": "Код двигателя",
//        "value": "7AFE",
//        "idx": ""
//      },
//      {
//          "key": "engine",
//        "name": "Двигатель",
//        "value": "1800CC 16-VALVE DOHC EFI",
//        "idx": ""
//      },
//      {
//          "key": "grade",
//        "name": "Класс",
//        "value": "PREMIO E TYPE",
//        "idx": ""
//      },
//      {
//          "key": "year",
//        "name": "Год",
//        "value": "1998",
//        "idx": ""
//      },
//      {
//          "key": "sales_region",
//        "name": "Регион",
//        "value": "Япония",
//        "idx": ""
//      },
//      {
//          "key": "trans_type",
//        "name": "Тип коробки передач",
//        "value": "МКПП",
//        "idx": ""
//      }
//    ]
//  }
//]





// данные по категориям
//[
//  {
//      "id": "MfCfmoAwMDE",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "Инструменты/Двигатель/Топливная система",
//    "img": null,
//    "description": null,
//    "parentId": null
//  },
//  {
//      "id": "MfCfmoAwMDM",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "Кузов",
//    "img": null,
//    "description": null,
//    "parentId": null
//  },
//  {
//      "id": "MfCfmoAwMDI",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "Силовая передача/Трансмиссия/Шасси",
//    "img": null,
//    "description": null,
//    "parentId": null
//  },
//  {
//      "id": "MfCfmoAwMDQ",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "Электрооборудование",
//    "img": null,
//    "description": null,
//    "parentId": null
//  }
//]



// подкатегория
//[
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ3MDM4MUE",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ВАКУУМНЫЙ ТОРМОЗНОЙ ЦИЛИНДР",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/470381A.png",
//    "description": "(9601-    )AT21#,ST21#\n\n\n[ 4703 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ3MDM3NyA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ГЛАВНЫЙ ТОРМОЗНОЙ ЦИЛИНДР",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/470377 .png",
//    "description": "(9601-    )\n\n\n[ 4702 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTMxMDQxNiA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ГЛАВНЫЙ ЦИЛИНДР СЦЕПЛЕНИЯ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/310416 .png",
//    "description": "(9601-    )AT21#..MTM\n\n\n[ 3103 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "MfCfmoAwMDLwn5uwSXpMd241cUFNREF5OEotYWdUUXhNRE0zTXlB",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "ДИСКИ И КОЛПАКИ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/410373 .png",
//    "description": null,
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agU1DVTg5OCA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ЗАДНЯЯ ОСИ И СТУПИЦА",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/MCU898 .png",
//    "description": "(9601-    )AT21#,CT210,211,ST210\n\n\n[ 4102 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ4MDIzOEM",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ЗАДНЯЯ ПОДВЕСКА ПРУЖИНЫ, АМОРТИЗАТОРЫ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/480238C.png",
//    "description": "(9601-    )AT21#,CT210,211,ST210\n\n\n[ 4804 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agU1DVjEyOCA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "КОРОБКА ПЕРЕДОЧ И РЕМКОМПЛЕКТ (МКПП)",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/MCV128 .png",
//    "description": "(9601-    )AT21#..MTM\nC57,C58\n\n\n[ 3301 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTMzNDg2NCA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "КОРПУС СЦЕПЛЕНИЯ И КОРПУС КОРОБКИ ПЕРЕДАЧ (МКПП)",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/334864 .png",
//    "description": "(9601-    )AT21#..MTM\nC57,C58\n\n\n[ 3302 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ3MDA2NiA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "МЕХАНИЗМ ЗАДНЕГО ТОРМОЗНОГО БАРАБАНА",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/470066 .png",
//    "description": "(9601-    )\n\n\n[ 4706 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ1MTY1NEE",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "НАСОС ГИДРОУСИЛИТЕЛЯ , БАЧЕК",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/451654A.png",
//    "description": "(9601-    )AT21#\n\n\n[ 4502 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "MfCfmoAwMDLwn5uwSXpMd241cUFNREF5OEotYWdVMURWakV4TmlB",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "ПЕДАЛЬ СЦЕПЛЕНИЯ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/MCV116 .png",
//    "description": null,
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ3MDA1MyA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ПЕДАЛЬ ТОРМОЗА",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/470053 .png",
//    "description": "(9601-    )\n\n\n[ 4701 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "MfCfmoAwMDLwn5uwSXpMd241cUFNREF5OEotYWdUUXpNekV3T0VF",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "ПЕРЕДНИЕ ПРИВОДА (ШРУС)",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/433108A.png",
//    "description": null,
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ3MDA1NUE",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ПЕРЕДНИЕ ТОРМОЗА (КОЛОДКИ, СУППОРТА, РЕМ К-Т, КОЖУХ)",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/470055A.png",
//    "description": "(9601-    )\n\n\n[ 4705 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ4MTEwMSA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ПЕРЕДНЯЯ ПОДВЕСКА ПРУЖИНЫ И АМОРТИЗАТОРЫ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/481101 .png",
//    "description": "(9601-    )\n\n\n[ 4803 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "MfCfmoAwMDLwn5uwSXpMd241cUFNREF5OEotYWdUUTRNamcxTjBF",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "ПЕРЕДНЯЯ ПОДВЕСКА РЫЧАГИ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/482857A.png",
//    "description": null,
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agU1DVTkwM0E",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ПЕРЕДНЯЯ СТУПИЦА И ТОРМОЗНОЙ ДИСК",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/MCU903A.png",
//    "description": "(9601-    )\n\n\n[ 4303 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQzMzEwMkE",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "РАЗДАТОЧНАЯ КОРОБКА И ДИФФЕРЕНЦИАЛ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/433102A.png",
//    "description": "(9601-    )AT21#..MTM\nC57,C58\n\n\n[ 4301 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ1MDQyN0M",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "РУЛЕВАЯ КОЛОНКА И КРЕСТОВИНЫ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/450427C.png",
//    "description": "(9601-    )\n\n\n[ 4501 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "MfCfmoAwMDLwn5uwSXpMd241cUFNREF5OEotYWdUUTFNakV4TjBF",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "РУЛЕВАЯ РЕЙКА И НАКОНЕЧНИКИ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/452117A.png",
//    "description": null,
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ1MTk1NyA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "РУЛЬ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/451957 .png",
//    "description": "(9712-    )\n\n\n[ 4504 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTMzMDQwMEE",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "РУЧКА ПЕРЕКЛЮЧЕНИЯ ПЕРЕДАЧ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/330400A.png",
//    "description": "(9601-    )AT21#..MTM\n\n\n[ 3312 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ2MDA1N0E",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "СТОЯНОЧНЫЙ ТОРМОЗ КОЛОДКИ ТРОСА. (РУЧНИК)",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/460057A.png",
//    "description": "(9601-    )AT21#,CT210,211,ST210\n\n\n[ 4601 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTMxMDIyNEE",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "СЦЕПЛЕНИЕ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/310224A.png",
//    "description": "(9601-    )AT21#..MTM\n\n\n[ 3101 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "MfCfmoAwMDLwn5uwSXpMd241cUFNREF5OEotYWdUUTNNRE00TUVJ",
//    "hasSubgroups": true,
//    "hasParts": false,
//    "name": "ТОРМОЗНАЯ МАГИСТРАЛЬ (ТРУБКИ)",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/470380B.png",
//    "description": null,
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTQ1MDQyOEE",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ТРУБКИ ГИДРОУСИЛИТЕЛЯ РУЛЯ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/450428A.png",
//    "description": "(9601-    )AT21#\n\n\n[ 4503 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTMzMDQwN0E",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ТЯГИ И ВИЛКИ ПЕРЕКЛЮЧЕНИЯ ПЕРЕДАЧ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/330407A.png",
//    "description": "(9601-    )AT21#..MTM\nC57,C58\n\n\n[ 3307 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agTMxMjAyOCA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ЦИЛИНДР СЦЕПЛЕНИЯ",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/312028 .png",
//    "description": "(9601-    )AT21#..MTM\n\n\n[ 3105 ]",
//    "parentId": "MfCfmoAwMDI"
//  },
//  {
//      "id": "IzLwn5qAMDAy8J-agU1DVjEzNCA",
//    "hasSubgroups": false,
//    "hasParts": true,
//    "name": "ШЕСТЕРНИ КОРОБКИ ПЕРЕДАЧ (МКПП)",
//    "img": "//img.parts-catalogs.com/r/320x220/toyota_2019_07/japan/MCV134 .png",
//    "description": "(9601-    )AT21#..MTM\nC57,C58\n\n\n[ 3305 ]",
//    "parentId": "MfCfmoAwMDI"
//  }
//]



// запчасти по агрегату
//{
//    "img": "//img.parts-catalogs.com/toyota_2019_07/japan/480238C.png",
//  "imgDescription": null,
//  "partGroups": [
//    {
//        "number": null,
//      "positionNumber": "42304",
//      "name": "CARRIER SUB-ASSY, REAR AXLE, RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4230420300",
//          "number": "42304-20300",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 01",
//          "positionNumber": "42304",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "42305",
//      "name": "CARRIER SUB-ASSY, REAR AXLE, LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4230520300",
//          "number": "42305-20300",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 01",
//          "positionNumber": "42305",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48231A",
//      "name": "SPRING, COIL, REAR RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "482312D820",
//          "number": "48231-2D820",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19971299999912/1997-\nМодели: AT21#,CT211,ST210\nКол-во деталей: 01",
//          "positionNumber": "48231A",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48231B",
//      "name": "SPRING, COIL, REAR LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "482312D820",
//          "number": "48231-2D820",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19971299999912/1997-\nМодели: AT21#,CT211,ST210\nКол-во деталей: 01",
//          "positionNumber": "48231B",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48258B",
//      "name": "INSULATOR, REAR COIL SPRING, LOWER RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4825832010",
//          "number": "48258-32010",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48258B",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48258C",
//      "name": "INSULATOR, REAR COIL SPRING, LOWER LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4825832010",
//          "number": "48258-32010",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48258C",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48341A",
//      "name": "BUMPER, REAR SPRING, NO.1 RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4834120270",
//          "number": "48341-20270",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#\nКол-во деталей: 01",
//          "positionNumber": "48341A",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48341B",
//      "name": "BUMPER, REAR SPRING, NO.1 LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4834120270",
//          "number": "48341-20270",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#\nКол-во деталей: 01",
//          "positionNumber": "48341B",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48530",
//      "name": "ABSORBER ASSY, SHOCK, REAR RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4853029735",
//          "number": "48530-29735",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19971299999912/1997-\nМодели: AT21#\nКол-во деталей: 01",
//          "positionNumber": "48530",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48540",
//      "name": "ABSORBER ASSY, SHOCK, REAR LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4854029295",
//          "number": "48540-29295",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19971299999912/1997-\nМодели: AT21#\nКол-во деталей: 01",
//          "positionNumber": "48540",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48703C",
//      "name": "NUT(FOR REAR SUSPENSION ARM)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9017914019",
//          "number": "90179-14019",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 04",
//          "positionNumber": "48703C",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48703E",
//      "name": "BOLT(FOR REAR SUSPENSION ARM)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9090109001",
//          "number": "90901-09001",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\n        ＊１４−１．５０ＰＸ２６０−２６,BODY SIDE\nКол-во деталей: 02",
//          "positionNumber": "48703E",
//          "url": ""
//        },
//        {
//            "id": "9090119001",
//          "number": "90901-19001",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\n        ＊１４−１．５０ＰＸ２６０−２６,CARRIER SIDE\nКол-во деталей: 02",
//          "positionNumber": "48703E",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48703H",
//      "name": "WASHER, NO.1(FOR REAR SUSPENSION ARM)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9020114017",
//          "number": "90201-14017",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 06",
//          "positionNumber": "48703H",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48703J",
//      "name": "WASHER, NO.2(FOR REAR SUSPENSION ARM)",
//      "description": null,
//      "parts": [
//        {
//            "id": "4871520020",
//          "number": "48715-20020",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19970899999908/1997-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 01",
//          "positionNumber": "48703J",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48710A",
//      "name": "ARM ASSY, REAR SUSPENSION, NO.1 RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4871020241",
//          "number": "48710-20241",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 01",
//          "positionNumber": "48710A",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48720A",
//      "name": "ARM ASSY, REAR SUSPENSION, NO.1 LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4871020241",
//          "number": "48710-20241",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 01",
//          "positionNumber": "48720A",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48730F",
//      "name": "ARM ASSY, REAR SUSPENSION, NO.2 RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4873020220",
//          "number": "48730-20220",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 01",
//          "positionNumber": "48730F",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48740F",
//      "name": "ARM ASSY, REAR SUSPENSION, NO.2 LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4874020080",
//          "number": "48740-20080",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT210,211,ST210\nКол-во деталей: 01",
//          "positionNumber": "48740F",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48750G",
//      "name": "NUT(FOR REAR SUSPENSION SUPPORT)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9017908122",
//          "number": "90179-08122",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 06",
//          "positionNumber": "48750G",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48750H",
//      "name": "SUPPORT ASSY, REAR SUSPENSION, RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4875020150",
//          "number": "48750-20150",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48750H",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48750K",
//      "name": "COLLAR(FOR REAR SUPPORT TO REAR SHOCK ABSORBER RH)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9038715027",
//          "number": "90387-15027",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48750K",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48753B",
//      "name": "COVER, REAR SUSPENSION SUPOPORT, NO.1 RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4875320040",
//          "number": "48753-20040",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48753B",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48753C",
//      "name": "COVER, REAR SUSPENSION SUPOPORT, NO.1 LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4875320040",
//          "number": "48753-20040",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48753C",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48753D",
//      "name": "COVER, REAR SUSPENSION SUPOPORT, NO.2 RH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4875320070",
//          "number": "48753-20070",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48753D",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48753E",
//      "name": "COVER, REAR SUSPENSION SUPOPORT, NO.2 LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4875320070",
//          "number": "48753-20070",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48753E",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48760B",
//      "name": "SUPPORT ASSY  REAR SUSPENSION, LH",
//      "description": null,
//      "parts": [
//        {
//            "id": "4875020150",
//          "number": "48750-20150",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48760B",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48760D",
//      "name": "COLLAR(FOR REAR SUPPORT TO REAR SHOCK ABSORBER LH)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9038715027",
//          "number": "90387-15027",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 01",
//          "positionNumber": "48760D",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48780A",
//      "name": "ROD ASSY, STRUT, REAR",
//      "description": null,
//      "parts": [
//        {
//            "id": "4878020200",
//          "number": "48780-20200",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19971299999912/1997-\nМодели: AT21#,CT211,ST210\nКол-во деталей: 02",
//          "positionNumber": "48780A",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48780B",
//      "name": "BOLT(FOR STRUT ROD)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9011912131",
//          "number": "90119-12131",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19960199999901/1996-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 04",
//          "positionNumber": "48780B",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48780C",
//      "name": "NUT(FOR STRUT ROD)",
//      "description": null,
//      "parts": [
//        {
//            "id": "9017912091",
//          "number": "90179-12091",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19970999999909/1997-\nМодели: AT21#,CT21#,ST21#\nКол-во деталей: 04",
//          "positionNumber": "48780C",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": "48785A",
//      "name": "DAMPER, STRUD ROD DYNAMIC",
//      "description": null,
//      "parts": [
//        {
//            "id": "4878520010",
//          "number": "48785-20010",
//          "name": null,
//          "notice": null,
//          "description": "Дата производства: 19971299999912/1997-\nМодели: AT21#,CT211,ST210\nКол-во деталей: 02",
//          "positionNumber": "48785A",
//          "url": ""
//        }
//      ]
//    },
//    {
//        "number": null,
//      "positionNumber": null,
//      "name": "Std Parts",
//      "description": null,
//      "parts": [
//        {
//            "id": "9418360801",
//          "number": "94183-60801",
//          "name": "** Std Part",
//          "notice": null,
//          "description": null,
//          "positionNumber": "9418360801",
//          "url": ""
//        },
//        {
//            "id": "9017915001",
//          "number": "90179-15001",
//          "name": "** Std Part",
//          "notice": null,
//          "description": null,
//          "positionNumber": "9017915001",
//          "url": ""
//        },
//        {
//            "id": "9010515001",
//          "number": "90105-15001",
//          "name": "** Std Part",
//          "notice": null,
//          "description": null,
//          "positionNumber": "9010515001",
//          "url": ""
//        },
//        {
//            "id": "9418461400",
//          "number": "94184-61400",
//          "name": "** Std Part",
//          "notice": null,
//          "description": null,
//          "positionNumber": "9418461400",
//          "url": ""
//        }
//      ]
//    }
//  ],
//  "positions": [
//    {
//        "number": "42304",
//      "coordinates": [
//        565,
//        822,
//        103,
//        20
//    ]
//    },
//    {
//        "number": "42305",
//      "coordinates": [
//        565,
//        842,
//        103,
//        20
//    ]
//    },
//    {
//        "number": "48530",
//      "coordinates": [
//        90,
//        188,
//        104,
//        20
//    ]
//    },
//    {
//        "number": "48540",
//      "coordinates": [
//        90,
//        207,
//        104,
//        20
//    ]
//    },
//    {
//        "number": "48703E",
//      "coordinates": [
//        36,
//        618,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48703E",
//      "coordinates": [
//        245,
//        792,
//        69,
//        21
//    ]
//    },
//    {
//        "number": "48703H",
//      "coordinates": [
//        201,
//        568,
//        69,
//        20
//    ]
//    },
//    {
//        "number": "48703H",
//      "coordinates": [
//        298,
//        636,
//        69,
//        20
//    ]
//    },
//    {
//        "number": "48703H",
//      "coordinates": [
//        581,
//        786,
//        69,
//        20
//    ]
//    },
//    {
//        "number": "48703J",
//      "coordinates": [
//        487,
//        591,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48703C",
//      "coordinates": [
//        530,
//        569,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48703C",
//      "coordinates": [
//        613,
//        697,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48730F",
//      "coordinates": [
//        503,
//        652,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48740F",
//      "coordinates": [
//        502,
//        671,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48780C",
//      "coordinates": [
//        454,
//        1005,
//        70,
//        21
//    ]
//    },
//    {
//        "number": "48780C",
//      "coordinates": [
//        311,
//        999,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48780A",
//      "coordinates": [
//        242,
//        1077,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48780B",
//      "coordinates": [
//        370,
//        855,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48780B",
//      "coordinates": [
//        184,
//        901,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48785A",
//      "coordinates": [
//        45,
//        1011,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "9418360801",
//      "coordinates": [
//        125,
//        1040,
//        111,
//        18
//    ]
//    },
//    {
//        "number": "48710A",
//      "coordinates": [
//        137,
//        724,
//        114,
//        21
//    ]
//    },
//    {
//        "number": "48720A",
//      "coordinates": [
//        137,
//        746,
//        114,
//        20
//    ]
//    },
//    {
//        "number": "9017915001",
//      "coordinates": [
//        291,
//        499,
//        140,
//        18
//    ]
//    },
//    {
//        "number": "9010515001",
//      "coordinates": [
//        414,
//        487,
//        140,
//        17
//    ]
//    },
//    {
//        "number": "9418461400",
//      "coordinates": [
//        228,
//        149,
//        140,
//        18
//    ]
//    },
//    {
//        "number": "48750K",
//      "coordinates": [
//        407,
//        82,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48760D",
//      "coordinates": [
//        408,
//        101,
//        115,
//        21
//    ]
//    },
//    {
//        "number": "48750G",
//      "coordinates": [
//        638,
//        103,
//        70,
//        20
//    ]
//    },
//    {
//        "number": "48750H",
//      "coordinates": [
//        638,
//        144,
//        115,
//        21
//    ]
//    },
//    {
//        "number": "48760B",
//      "coordinates": [
//        639,
//        164,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48753B",
//      "coordinates": [
//        628,
//        4,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48753C",
//      "coordinates": [
//        628,
//        23,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48341A",
//      "coordinates": [
//        628,
//        262,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48341B",
//      "coordinates": [
//        628,
//        283,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48231A",
//      "coordinates": [
//        640,
//        347,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48231B",
//      "coordinates": [
//        640,
//        368,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48258B",
//      "coordinates": [
//        640,
//        440,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48258C",
//      "coordinates": [
//        640,
//        461,
//        115,
//        20
//    ]
//    },
//    {
//        "number": "48753E",
//      "coordinates": [
//        164,
//        69,
//        114,
//        20
//    ]
//    },
//    {
//        "number": "48753D",
//      "coordinates": [
//        164,
//        47,
//        114,
//        20
//    ]
//    },
//    {
//        "number": "48703J",
//      "coordinates": [
//        219,
//        441,
//        69,
//        20
//    ]
//    }
//  ]
//}
