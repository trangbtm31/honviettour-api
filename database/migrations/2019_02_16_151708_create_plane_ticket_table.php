<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaneTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plane_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_place');
            $table->string('to_place');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->float('price');
            $table->tinyInteger('person_type'); // 0 for baby, 1 for child, 2 for adult
            $table->tinyInteger('type'); // 0 for one-way, 1 for round-trip
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
        Schema::dropIfExists('plane_ticket');
    }
}
