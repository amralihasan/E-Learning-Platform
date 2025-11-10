<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelExamQuestion extends Model
{
    protected $fillable = [
        'level_exam_id',
        'section',
        'question_text',
        'question_type',
        'audio_url',
        'reading_passage',
        'order',
        'points',
    ];

    public function levelExam(): BelongsTo
    {
        return $this->belongsTo(LevelExam::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(LevelExamAnswer::class, 'question_id')->orderBy('order');
    }
}
