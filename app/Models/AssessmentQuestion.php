<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssessmentQuestion extends Model
{
    protected $fillable = [
        'assessment_id',
        'section',
        'question_text',
        'question_type',
        'audio_url',
        'reading_passage',
        'order',
        'points',
    ];

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AssessmentAnswer::class, 'question_id')->orderBy('order');
    }

    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserAssessmentAnswer::class, 'question_id');
    }
}
