<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->jsonb('title');
            $table->jsonb('keywords');
            $table->jsonb('description');
            $table->jsonb('phone');
            $table->string('email');
            $table->boolean('buy_one')->default(true);
            $table->jsonb('address');
            $table->jsonb('socials');
            $table->jsonb('other')->default('{"delivery":{"ru":"","uz":""},"pickup":{"ru":"","uz":""}}');
            $table->boolean('pickup')->default(true);
            $table->jsonb('permissions')->default('{"news": true, "middle_banner": true, "special_block":true,"lider_products":true,"popular_products":true,"new_products":true,"popular_categories":true,"brands":true}');
            $table->boolean('on_credit')->default(false);
            $table->boolean('delivery')->default(true);
            $table->jsonb('pickup_text')->default('{"ru":"","uz":""}');
            $table->integer('price_delivery')->default(10000);
            $table->integer('day_delivery')->default(1);
            $table->jsonb('landmark');
            $table->jsonb('links')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
