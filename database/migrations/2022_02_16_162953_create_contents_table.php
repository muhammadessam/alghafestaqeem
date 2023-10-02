<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();//rank
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('counter')->nullable();
            $table->string('sign')->nullable();
            $table->longText('description')->nullable();
            $table->string('slug')->default('01')->nullable();
            $table->integer('type')->default(0)->nullable();
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
        Schema::dropIfExists('contents');
    }
}