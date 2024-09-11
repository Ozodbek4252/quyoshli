<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('count')->default(1);
            $table->integer('price')->default(0);
            $table->unsignedBigInteger('color_id')->nullable();
            $table->string('size')->nullable();
            $table->integer('discount')->nullable();
            //$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
