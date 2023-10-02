<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * php artisan make:migration add_location_to_rate_requests_table --table=rate_requests

     * @return void
     */
    public function up()
    {
        Schema::create('rate_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->longText('notes')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('type_id')->nullable()->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreignId('usage_id')->nullable()->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreignId('entity_id')->nullable()->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreignId('goal_id')->nullable()->references('id')
                ->on('categories')->onDelete('cascade');

            $table->longText('real_estate_details')->nullable();

            $table->integer('real_estate_age')->default(0)->nullable();
            $table->integer('real_estate_area')->default(0)->nullable();
            $table->integer('status')->default(0)->nullable();
            $table->string('request_no')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('rate_requests');
    }
}