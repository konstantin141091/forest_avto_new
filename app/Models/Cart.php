<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'product_id',
        'article',
        'name',
        'shop_name',
        'partnumber',
//        offers
        'offers_id',
        'offers_name',
        'offers_type',
        'offers_price',
        'offers_average_period',
        'offers_assured_period',
        'offers_reliability',
        'offers_is_transit',
        'offers_quantity',
        'offers_available_more',
        'offers_multiplication_factor',
        'offers_delivery_type',
//данные бренда
        'brand_id',
        'brand_name',
//        данные по корзине
        'quantity',
        'total',
        'session_id'
    ];
}
