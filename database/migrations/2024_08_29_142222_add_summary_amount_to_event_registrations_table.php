<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSummaryAmountToEventRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Add the summary_amount column with a default value
            $table->decimal('summary_amount', 10, 2)->nullable()->after('amount');
        });
    }

    public function down()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Remove the summary_amount column
            $table->dropColumn('summary_amount');
        });
    }
}