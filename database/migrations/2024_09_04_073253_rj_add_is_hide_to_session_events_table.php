<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RjAddIsHideToSessionEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions_events', function (Blueprint $table) {
            $table->enum('is_hide', ['show', 'block'])->default('show')->after('amount'); // Adjust 'existing_column' as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions_events', function (Blueprint $table) {
            $table->dropColumn('is_hide');
        });
    }
}
