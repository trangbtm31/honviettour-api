<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropForeign('ratings_hotel_id_foreign');
            $table->dropColumn('hotel_id');
            $table->integer('model_id')->after('user_id');
            $table->string('model_type')->after('model_id');
            $table->smallInteger('rating')->after('model_type');
            $table->string('lang', 2)->after('comment');
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
