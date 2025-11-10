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
        Schema::table('user_unlocked_levels', function (Blueprint $table) {
            $table->foreign('unlocked_by_exam_id')->references('id')->on('user_level_exams')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_unlocked_levels', function (Blueprint $table) {
            $table->dropForeign(['unlocked_by_exam_id']);
        });
    }
};
