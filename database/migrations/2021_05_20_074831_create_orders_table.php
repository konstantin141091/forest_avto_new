<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_id');
            $table->string('name');
            $table->string('phone');
            $table->enum('delivery_method', [
                'доставка',
                'самовывоз'
            ]);
            $table->string('address')->nullable();
            $table->string('comment')->nullable();
            $table->enum('payment_method', [
                'наличными курьеру',
                'картой курьеру',
                'при самовывозе',
            ]);
            $table->unsignedBigInteger('total_price');
            $table->enum('status', [
                'оформлен',
                'в работе',
                'выполнен',
            ]);
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
        Schema::dropIfExists('orders');
    }
}
