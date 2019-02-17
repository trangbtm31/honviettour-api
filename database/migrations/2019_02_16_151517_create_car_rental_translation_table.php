<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarRentalTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_rental_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('from_place');
            $table->string('to_place');
            $table->string('content');
            $table->string('note')->nullable();
            $table->tinyInteger('vehicle_type');
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
        Schema::dropIfExists('car_rental_translations');
    }
}
