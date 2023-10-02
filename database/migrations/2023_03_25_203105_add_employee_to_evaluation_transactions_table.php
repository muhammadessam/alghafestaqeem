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
            //status
            $table->dropColumn('income');
            $table->dropColumn('previewer');
            $table->dropColumn('review');


            $table->foreignId('previewer_id')->nullable()->references('id')
                ->on('evaluation_employees')->onDelete('cascade');

            $table->foreignId('income_id')->nullable()->references('id')
                ->on('evaluation_employees')->onDelete('cascade');

            $table->foreignId('review_id')->nullable()->references('id')
                ->on('evaluation_employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            //
            $table->boolean('income')->nullable();
            $table->boolean('previewer')->nullable();
            $table->boolean('review')->nullable();

            $table->dropForeign('income_id');
            $table->dropForeign('previewer_id');
            $table->dropForeign('review_id');

            $table->dropColumn('income_id');
            $table->dropColumn('previewer_id');
            $table->dropColumn('review_id');

        });
    }
};
