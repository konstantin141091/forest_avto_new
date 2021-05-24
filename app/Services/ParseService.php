<?php


namespace App\Services;

use App\Services\BergAPI;

class ParseService
{
    public $bergApi;

    public function __construct()
    {
        $this->bergApi = new BergAPI();
    }

}
