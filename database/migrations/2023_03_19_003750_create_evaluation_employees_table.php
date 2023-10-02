<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluation_employees', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->float('price')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();//rank
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_employees');
    }
};
