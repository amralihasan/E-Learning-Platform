<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserUnlockedLevel extends Model
{
    protected $fillable = [
        'user_id',
        'level',
        'unlocked_at',
        'unlocked_via',
        'unlocked_by_assessment_id',
        'unlocked_by_exam_id',
    ];

    protected $casts = [
        'unlocked_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(UserAssessment::class, 'unlocked_by_assessment_id');
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(UserLevelExam::class, 'unlocked_by_exam_id');
    }
}
