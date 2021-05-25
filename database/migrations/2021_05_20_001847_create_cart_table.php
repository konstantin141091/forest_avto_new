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
            $table->string('session_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('total');
//            по продукту
            $table->string('product_id');
            $table->string('article');
            $table->string('name');
            $table->string('shop_name');
            $table->string('partnumber')->nullable();
//            по складу
            $table->string('offers_id')->nullable();
            $table->string('offers_name')->nullable();
            $table->string('offers_price');
            $table->string('offers_average_period')->nullable();
            $table->string('offers_assured_period')->nullable();
            $table->string('offers_quantity')->nullable();
//            по бренду
            $table->string('brand_id')->nullable();
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
