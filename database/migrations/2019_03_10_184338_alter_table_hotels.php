<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableHotels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('photo');
            $table->dropColumn('description');
            $table->dropColumn('service');
            $table->dropColumn('country');
            $table->smallInteger('country_id')->after('id');
            $table->tinyInteger('status')->default(0)->afer('longitude');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
