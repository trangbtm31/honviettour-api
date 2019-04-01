<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableHasGallery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->text('gallery')->nullable()->change();
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->text('gallery')->nullable()->change();
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->text('gallery')->nullable()->change();
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
