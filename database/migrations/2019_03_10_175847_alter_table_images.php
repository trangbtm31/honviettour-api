<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropForeign('images_hotel_id_foreign');
            $table->dropForeign('images_tour_id_foreign');
            $table->dropColumn('hotel_id');
            $table->dropColumn('tour_id');
            $table->integer('model_id')->after('id');
            $table->string('model_type')->after('model_id');
            $table->string('path', 255)->after('model_type');
            $table->dropColumn('status');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('path');
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