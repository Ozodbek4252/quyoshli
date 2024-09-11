<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliverySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('pickup')->default(true);
            $table->boolean('delivery')->default(true);
            $table->jsonb('pickup_text')->default('{"ru":"","uz":""}');
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
            $table->boolean('pickup')->default(true);
            $table->boolean('delivery')->default(true);
            $table->jsonb('pickup_text')->default('{"ru":"","uz":""}');
        });
    }
}
