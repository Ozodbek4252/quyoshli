<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPermissionsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->jsonb('permissions')->default('{"news": true, "middle_banner": true, "special_block":true,"lider_products":true,"popular_products":true,"new_products":true,"popular_categories":true,"brands":true}');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->jsonb('permissions')->default('{"news": true, "middle_banner": true, "special_block":true,"lider_products":true,"popular_products":true,"new_products":true,"popular_categories":true,"brands":true}');
        });
    }
}
