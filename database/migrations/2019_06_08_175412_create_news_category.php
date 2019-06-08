<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status');
            $table->timestamps();
        });
        Schema::create('news_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_category_id')->unsigned();
            $table->foreign('news_category_id')->references('id')->on('news_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('lang', 2);
            $table->string('name', 32);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_categories');
        Schema::dropIfExists('news_category_translations');
    }
}
