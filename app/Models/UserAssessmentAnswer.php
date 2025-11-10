<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAssessmentAnswer extends Model
{
    protected $fillable = [
        'user_assessment_id',
        'question_id',
        'answer_id',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function userAssessment(): BelongsTo
    {
        return $this->belongsTo(UserAssessment::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(AssessmentQuestion::class, 'question_id');
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(AssessmentAnswer::class, 'answer_id');
    }
}
