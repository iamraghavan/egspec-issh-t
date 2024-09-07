<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id('speaker_id');
            $table->string('full_name');
            $table->string('job_title');
            $table->string('organization');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('linkedin_profile')->nullable();
            $table->string('website_url')->nullable();
            $table->longText('bio');
            $table->text('education')->nullable();
            $table->text('achievements')->nullable();
            $table->text('social_media_handles')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('speakers');
    }
}
