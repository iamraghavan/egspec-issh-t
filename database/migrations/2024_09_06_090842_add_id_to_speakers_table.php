<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdToSpeakersTable extends Migration
{
    public function up()
    {
        Schema::table('speakers', function (Blueprint $table) {
            // Add the auto-incrementing id column
            $table->bigIncrements('id')->first();
        });
    }

    public function down()
    {
        Schema::table('speakers', function (Blueprint $table) {

            $table->dropColumn('id');
        });
    }
}
