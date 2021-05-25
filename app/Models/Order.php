<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'session_id',
        'name',
        'phone',
        //доставка
        'delivery_method',
        'address',
        'comment',
        //оплата
        'payment_method',
        'total_price',
        'total_quantity',
        'status',
    ];
}
