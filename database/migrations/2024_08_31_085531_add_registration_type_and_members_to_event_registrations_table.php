<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRegistrationTypeAndMembersToEventRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Add registration_type column
            $table->enum('registration_type', ['individual', 'group'])->default('individual')->after('event_id');

            // Add members column to store member details in JSON format
            $table->json('members')->nullable()->after('summary_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_registrations', function (Blueprint $table) {
            // Drop the registration_type column
            $table->dropColumn('registration_type');

            // Drop the members column
            $table->dropColumn('members');
        });
    }
}
