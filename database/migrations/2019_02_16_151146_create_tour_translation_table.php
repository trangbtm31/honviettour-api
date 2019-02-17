<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('price_for_baby');
            $table->string('price_for_child');
            $table->string('price_for_adult');
            $table->string('start_place');
            $table->string('service');
            $table->integer('available_number');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('end_plane_id')->unsigned();
            $table->foreign('end_plane_id')->references('id')->on('planes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('start_plane_id')->unsigned();
            $table->foreign('start_plane_id')->references('id')->on('planes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('tour_guide_id')->unsigned();
            $table->foreign('tour_guide_id')->references('id')->on('tour_guides')->onDelete('cascade')->onUpdate('cascade');
            $table->string('note');
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
        Schema::dropIfExists('tour_translations');
    }
}
