<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->jsonb('name');
            $table->string('image')->nullable();
            $table->string('slug');

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('credit')->default(true);
            $table->boolean('popular')->default(false);
            $table->jsonb('title_seo')->default('{"ru":"","uz":""}');
            $table->jsonb('descriptions')->default('{"ru":"","uz":""}');
            $table->jsonb('keywords')->default('{"ru":"","uz":""}');
            $table->boolean('published')->default(true);
            $table->timestamps();
            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
