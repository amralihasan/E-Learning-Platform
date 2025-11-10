<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonQuiz extends Model
{
    protected $fillable = [
        'lesson_id',
        'title',
        'description',
        'passing_percentage',
        'is_active',
    ];

    protected $casts = [
        'passing_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(LessonQuizQuestion::class)->orderBy('order');
    }
}
