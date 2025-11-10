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
        Schema::create('lesson_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->enum('section_type', [
                'introduction',
                'conversation',
                'grammar',
                'reading',
                'vocabulary',
                'listening',
                'speaking',
                'writing',
                'youtube',
                'quiz'
            ]);
            $table->text('content')->nullable(); // Rich text content for the section
            $table->string('youtube_url')->nullable(); // For youtube section type
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique(['lesson_id', 'section_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_sections');
    }
};
