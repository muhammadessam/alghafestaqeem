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
            /**
             * Status:
             * 0 - جديد
             * 1 - جاري العمل عليها
             * 2 - تم التواصل
             * 3 - المعاينة
             * 4 - مكتملة
             * 5 - معلقة
             * 6 - ملغي
             */
            $table->integer('status')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
};
