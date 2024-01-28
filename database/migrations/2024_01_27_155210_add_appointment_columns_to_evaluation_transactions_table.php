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
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            $table->dateTime('preview_date_time')->nullable()->default(null);
            $table->dateTime('income_date_time')->nullable()->default(null);
            $table->dateTime('review_date_time')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            $table->dropColumn('preview_date_time');
            $table->dropColumn('income_date_time');
            $table->dropColumn('review_date_time');
        });
    }
};
