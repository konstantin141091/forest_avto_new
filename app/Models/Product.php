<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_id',
        'article',
        'name',
        'shop_name',
        'partnumber',
//        offers
        'offers_id',
        'offers_name',
        'offers_price',
        'offers_average_period',
        'offers_assured_period',
        'offers_quantity',
//данные бренда
        'brand_id',
        'brand_name',
    ];

}
