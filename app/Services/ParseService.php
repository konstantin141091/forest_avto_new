<?php


namespace App\Services;

class ParseService
{
    public $bergApi;
    public $rosskoApi;
    public $avtoPiterApi;

    public function __construct()
    {
        $this->bergApi = new BergAPI();
        $this->rosskoApi = new RosskoAPI();
        $this->avtoPiterApi = new AvtoPiterAPI();
    }

}
