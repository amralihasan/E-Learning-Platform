<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLevelExam extends Model
{
    protected $fillable = [
        'user_id',
        'level_exam_id',
        'level',
        'score',
        'max_score',
        'percentage',
        'passed',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'passed' => 'boolean',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function levelExam(): BelongsTo
    {
        return $this->belongsTo(LevelExam::class);
    }
}
