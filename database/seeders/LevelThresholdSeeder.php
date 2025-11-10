<?php

namespace Database\Seeders;

use App\Models\LevelThreshold;
use Illuminate\Database\Seeder;

class LevelThresholdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $thresholds = [
            ['level' => 'A1', 'min_percentage' => 0, 'max_percentage' => 20, 'order' => 1],
            ['level' => 'A2', 'min_percentage' => 21, 'max_percentage' => 40, 'order' => 2],
            ['level' => 'B1', 'min_percentage' => 41, 'max_percentage' => 60, 'order' => 3],
            ['level' => 'B2', 'min_percentage' => 61, 'max_percentage' => 80, 'order' => 4],
            ['level' => 'C1', 'min_percentage' => 81, 'max_percentage' => 95, 'order' => 5],
            ['level' => 'C2', 'min_percentage' => 96, 'max_percentage' => 100, 'order' => 6],
        ];

        foreach ($thresholds as $threshold) {
            LevelThreshold::updateOrCreate(
                ['level' => $threshold['level']],
                $threshold
            );
        }
    }
}
