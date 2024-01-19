<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('token')->unique();
            $table->string('client_name');
            $table->string('id_number');
            $table->text('client_address');
            $table->text('phone_numbers');
            $table->string('email');
            $table->string('representative_name');
            $table->string('purpose');
            $table->string('type');
            $table->unsignedFloat('area');
            $table->text('property_address');
            $table->string('deed_number');
            $table->date('deed_issue_date');
            $table->unsignedInteger('number_of_assets');
            $table->unsignedFloat('cost_per_asset');
            $table->unsignedFloat('total_cost');
            $table->unsignedFloat('tax');
            $table->text('total_cost_in_words');
            $table->text('signature')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
