<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id('cart_id');
//            $table->unsignedBigInteger('cart_id');
//            $table->primary('cart_id');
            $table->string('session_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('total');
//            по продукту
            $table->string('id');
            $table->string('article');
            $table->string('name');
            $table->string('shop_name');
            $table->string('offers_id');
            $table->string('offers_name');
            $table->string('offers_type')->nullable();
            $table->string('offers_price');
            $table->string('offers_average_period')->nullable();
            $table->string('offers_assured_period')->nullable();
            $table->string('offers_reliability')->nullable();
            $table->boolean('offers_is_transit')->default(false);
            $table->string('offers_quantity')->nullable();
            $table->boolean('offers_available_more')->default(false);
            $table->string('offers_multiplication_factor')->nullable();
            $table->string('offers_delivery_type')->nullable();
            $table->string('brand_id');
            $table->string('brand_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
