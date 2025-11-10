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
        Schema::create('level_exams', function (Blueprint $table) {
            $table->id();
            $table->string('level', 2); // A1, A2, B1, B2, C1, C2
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('passing_percentage', 5, 2)->default(70.00); // Default 70% to pass
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->unique('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_exams');
    }
};
