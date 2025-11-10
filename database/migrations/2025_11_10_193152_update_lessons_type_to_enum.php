<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change type column to enum
        DB::statement("ALTER TABLE lessons MODIFY COLUMN type ENUM('conversation', 'grammar', 'reading', 'vocabulary', 'listening', 'speaking', 'writing', 'youtube', 'quiz') DEFAULT 'reading'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('type')->default('video')->change();
        });
    }
};
