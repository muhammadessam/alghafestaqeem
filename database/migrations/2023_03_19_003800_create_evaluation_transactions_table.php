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
        Schema::create('evaluation_transactions', function (Blueprint $table) {
            $table->id();

            $table->string('instrument_number')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('region')->nullable();
            $table->longText('notes')->nullable();
            $table->date('date')->nullable();
            $table->boolean('is_iterated')->nullable();
            $table->boolean('income')->nullable();
            $table->boolean('illustration')->nullable();
            $table->boolean('previewer')->nullable();
            $table->boolean('review')->nullable();
            $table->foreignId('type_id')->nullable()->references('id')
                ->on('categories')->onDelete('cascade');

            $table->foreignId('evaluation_company_id')->nullable()->references('id')
                ->on('evaluation_companies')->onDelete('cascade');

            $table->foreignId('evaluation_employee_id')->nullable()->references('id')
                ->on('evaluation_employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_transactions');
    }
};