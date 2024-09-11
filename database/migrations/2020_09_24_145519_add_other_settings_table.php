<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->jsonb('other')->default('{"delivery":{"ru":"","uz":""},"pickup":{"ru":"","uz":""}}');
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
            $table->jsonb('other')->default('{"delivery":{"ru":"","uz":""},"pickup":{"ru":"","uz":""}}');
        });
    }
}
