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
            $table->jsonb('address');
            $table->jsonb('socials');
            $table->integer('price_delivery')->default(10000);
            $table->integer('day_delivery')->default(1);
            $table->jsonb('landmark');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
