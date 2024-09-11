<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('address_id')->nullable();

            $table->integer('price_product')->default(0);
            $table->integer('price_delivery')->nullable();
//            $table->integer('price_product')->nullable();
            $table->integer('discount')->nullable();

            $table->timestamp('shipment_date')->nullable();

            $table->enum('type_delivery', ['delivery', 'pickup'])->default('delivery');
            $table->jsonb('currency');
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->enum('status', ['processing', 'collected', 'waiting_buyer', 'in_way', 'closed', 'cancelled', 'replacement', 'completed'])->default('processing');

            $table->enum('payment_type', ['cash', 'payme', 'apelsin', 'click', 'uzcard', 'oson', 'credit', 'upay', 'paynet'])->default('cash');
            $table->enum('payment_status', ['waiting', 'cancelled', 'payed', 'cash', 'review'])->default('waiting');

            $table->text('comment')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
