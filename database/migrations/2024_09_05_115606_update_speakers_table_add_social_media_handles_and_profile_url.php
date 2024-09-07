<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSpeakersTableAddSocialMediaHandlesAndProfileUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('speakers', function (Blueprint $table) {
            // Change social_media_handles column to JSON
            $table->json('social_media_handles')->nullable()->change();

            // Add profile_url column
            $table->string('profile_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('speakers', function (Blueprint $table) {
            // Revert social_media_handles column to TEXT
            $table->text('social_media_handles')->nullable()->change();

            // Drop profile_url column
            $table->dropColumn('profile_url');
        });
    }
}
