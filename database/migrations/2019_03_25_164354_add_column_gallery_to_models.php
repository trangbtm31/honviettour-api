<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGalleryToModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->string('photo');
            $table->text('gallery');
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->string('photo');
            $table->text('gallery');
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->string('photo');
            $table->text('gallery');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('gallery');
        });

        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('gallery');
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('gallery');
        });
    }
}
