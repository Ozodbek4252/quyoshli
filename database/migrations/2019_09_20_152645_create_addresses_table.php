<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');
            $table->string('first_name')->nullable();
//            $table->string('city');
//            $table->string('region');
            $table->bigInteger('phone');
            $table->bigInteger('phone_other')->nullable();
            $table->string('street')->nullable();
            $table->string('apartment')->nullable();
            $table->string('floor')->nullable();
            $table->string('entrance')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('cities');

        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
