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
        Schema::create('level_thresholds', function (Blueprint $table) {
            $table->id();
            $table->string('level', 2)->unique(); // A1, A2, B1, B2, C1, C2
            $table->decimal('min_percentage', 5, 2); // 0.00 to 100.00
            $table->decimal('max_percentage', 5, 2); // 0.00 to 100.00
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_thresholds');
    }
};
