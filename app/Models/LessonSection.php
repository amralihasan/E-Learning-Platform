<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonSection extends Model
{
    protected $fillable = [
        'lesson_id',
        'section_type',
        'content',
        'youtube_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserLessonProgress::class, 'section_id');
    }
}
