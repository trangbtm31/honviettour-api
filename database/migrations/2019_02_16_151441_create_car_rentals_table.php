<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_rentals', function (Blueprint $table) {
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
        Schema::dropIfExists('car_rentals');
    }
}
