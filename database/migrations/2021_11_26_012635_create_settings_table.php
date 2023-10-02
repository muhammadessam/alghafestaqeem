<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youTube')->nullable();
            $table->string('telegram')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('whats_app')->nullable();

            $table->string('title')->nullable();
            $table->longText('about')->nullable();
            $table->string('header')->nullable();
            $table->string('footer')->nullable();
            $table->longText('slider')->nullable();
            $table->string('service')->nullable();
            $table->string('objective')->nullable();
            $table->string('address')->nullable();

            $table->string('page_background')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('slider_image')->nullable();
            $table->string('objective_image')->nullable();
            $table->string('about_image')->nullable();

            $table->string('appStore')->nullable();
            $table->string('googlePlay')->nullable();

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
        Schema::dropIfExists('settings');
    }
}