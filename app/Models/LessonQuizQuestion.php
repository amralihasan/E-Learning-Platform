<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonQuizQuestion extends Model
{
    protected $fillable = [
        'lesson_quiz_id',
        'question_text',
        'question_type',
        'order',
        'points',
    ];

    public function lessonQuiz(): BelongsTo
    {
        return $this->belongsTo(LessonQuiz::class, 'lesson_quiz_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(LessonQuizAnswer::class, 'question_id')->orderBy('order');
    }
}
