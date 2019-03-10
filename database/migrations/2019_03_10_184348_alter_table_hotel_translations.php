<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableHotelTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_translations', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->string('name')->after('id');
            $table->text('description')->change();
            $table->text('service')->change();
            $table->string('lang', 2)->after('hotel_id');
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