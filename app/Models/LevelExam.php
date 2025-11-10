<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelExam extends Model
{
    protected $fillable = [
        'level',
        'title',
        'description',
        'passing_percentage',
        'is_active',
    ];

    protected $casts = [
        'passing_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(LevelExamQuestion::class)->orderBy('section')->orderBy('order');
    }

    public function userExams(): HasMany
    {
        return $this->hasMany(UserLevelExam::class);
    }
}
