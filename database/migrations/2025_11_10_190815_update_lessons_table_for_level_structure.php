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
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('level', 2)->nullable()->after('course_id'); // A1, A2, B1, B2, C1, C2
            $table->foreignId('unit_id')->nullable()->after('level')->constrained()->onDelete('cascade');
            $table->integer('lesson_number')->nullable()->after('unit_id'); // 1-4 within unit
            $table->text('description')->change(); // Make it rich text compatible
            $table->string('main_image')->nullable()->after('description');
            $table->string('audio')->nullable()->after('main_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign(['unit_id']);
            $table->dropColumn(['level', 'unit_id', 'lesson_number', 'main_image', 'audio']);
        });
    }
};
