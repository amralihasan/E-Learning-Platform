<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'starting_level',
        'current_level',
        'has_completed_onboarding',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'has_completed_onboarding' => 'boolean',
        ];
    }

    public function assessments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserAssessment::class);
    }

    public function unlockedLevels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserUnlockedLevel::class)->orderBy('unlocked_at');
    }

    public function levelExams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLevelExam::class);
    }

    public function lessonProgress(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserLessonProgress::class);
    }

    public function hasUnlockedLevel(string $level): bool
    {
        return $this->unlockedLevels()->where('level', $level)->exists();
    }

    public function getUnlockedLevelsArray(): array
    {
        return $this->unlockedLevels()->pluck('level')->toArray();
    }

    public function getHighestUnlockedLevel(): ?string
    {
        $levels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
        $unlocked = $this->getUnlockedLevelsArray();
        
        foreach (array_reverse($levels) as $level) {
            if (in_array($level, $unlocked)) {
                return $level;
            }
        }
        
        return null;
    }
}
