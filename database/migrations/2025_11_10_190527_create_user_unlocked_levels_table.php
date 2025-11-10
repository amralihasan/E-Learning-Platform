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
        Schema::create('user_unlocked_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('level', 2); // A1, A2, B1, B2, C1, C2
            $table->timestamp('unlocked_at');
            $table->enum('unlocked_via', ['assessment', 'level_exam'])->default('assessment');
            $table->foreignId('unlocked_by_assessment_id')->nullable()->constrained('user_assessments')->onDelete('set null');
            $table->unsignedBigInteger('unlocked_by_exam_id')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_unlocked_levels');
    }
};
