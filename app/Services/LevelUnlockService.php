<?php

namespace App\Services;

use App\Models\User;
use App\Models\LevelThreshold;
use App\Models\UserUnlockedLevel;

class LevelUnlockService
{
    /**
     * Unlock levels for a user based on assessment score percentage
     */
    public function unlockLevelsBasedOnScore(User $user, float $percentage, ?int $assessmentId = null): array
    {
        $unlockedLevels = [];
        $levels = LevelThreshold::where('is_active', true)
            ->where('min_percentage', '<=', $percentage)
            ->orderBy('order')
            ->get();

        foreach ($levels as $threshold) {
            // Check if user already has this level unlocked
            if (!$user->hasUnlockedLevel($threshold->level)) {
                UserUnlockedLevel::create([
                    'user_id' => $user->id,
                    'level' => $threshold->level,
                    'unlocked_at' => now(),
                    'unlocked_via' => 'assessment',
                    'unlocked_by_assessment_id' => $assessmentId,
                ]);
                $unlockedLevels[] = $threshold->level;
            }
        }

        // Update user's current level to highest unlocked
        $highestLevel = $user->getHighestUnlockedLevel();
        if ($highestLevel) {
            $user->current_level = $highestLevel;
            $user->save();
        }

        return $unlockedLevels;
    }

    /**
     * Unlock a specific level via level exam
     */
    public function unlockLevelViaExam(User $user, string $level, int $examId): bool
    {
        // Check if user already has this level
        if ($user->hasUnlockedLevel($level)) {
            return false;
        }

        // Check if user can unlock this level (must have previous level unlocked)
        if (!$this->canUnlockLevel($user, $level)) {
            return false;
        }

        UserUnlockedLevel::create([
            'user_id' => $user->id,
            'level' => $level,
            'unlocked_at' => now(),
            'unlocked_via' => 'level_exam',
            'unlocked_by_exam_id' => $examId,
        ]);

        // Update user's current level if this is higher
        $highestLevel = $user->getHighestUnlockedLevel();
        if ($highestLevel) {
            $user->current_level = $highestLevel;
            $user->save();
        }

        return true;
    }

    /**
     * Check if user can unlock a specific level
     */
    public function canUnlockLevel(User $user, string $level): bool
    {
        $levels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
        $levelIndex = array_search($level, $levels);

        if ($levelIndex === false) {
            return false;
        }

        // A1 can always be unlocked
        if ($levelIndex === 0) {
            return true;
        }

        // Check if previous level is unlocked
        $previousLevel = $levels[$levelIndex - 1];
        return $user->hasUnlockedLevel($previousLevel);
    }

    /**
     * Get all unlocked levels for a user
     */
    public function getUnlockedLevels(User $user): array
    {
        return $user->getUnlockedLevelsArray();
    }

    /**
     * Get highest unlocked level for a user
     */
    public function getHighestUnlockedLevel(User $user): ?string
    {
        return $user->getHighestUnlockedLevel();
    }
}

