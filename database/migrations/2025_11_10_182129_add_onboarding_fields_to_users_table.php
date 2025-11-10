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
        Schema::table('users', function (Blueprint $table) {
            $table->string('starting_level')->nullable()->after('password'); // A1, A2, B1, B2, C1, C2
            $table->boolean('has_completed_onboarding')->default(false)->after('starting_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['starting_level', 'has_completed_onboarding']);
        });
    }
};
