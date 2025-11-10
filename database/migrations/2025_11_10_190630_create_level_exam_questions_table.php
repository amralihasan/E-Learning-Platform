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
        Schema::create('level_exam_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_exam_id')->constrained()->onDelete('cascade');
            $table->enum('section', ['reading', 'listening', 'grammar']);
            $table->text('question_text');
            $table->string('question_type')->default('multiple_choice');
            $table->string('audio_url')->nullable();
            $table->text('reading_passage')->nullable();
            $table->integer('order')->default(0);
            $table->integer('points')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_exam_questions');
    }
};
