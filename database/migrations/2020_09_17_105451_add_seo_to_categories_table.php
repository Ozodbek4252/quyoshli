<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->jsonb('descriptions')->default('{"ru":"","uz":""}');
            $table->jsonb('keywords')->default('{"ru":"","uz":""}');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->jsonb('descriptions')->default('{"ru":"","uz":""}');
            $table->jsonb('keywords')->default('{"ru":"","uz":""}');
        });
    }
}
