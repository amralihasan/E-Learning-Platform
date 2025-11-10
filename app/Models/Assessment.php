<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessment extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(AssessmentQuestion::class)->orderBy('section')->orderBy('order');
    }

    public function userAssessments(): HasMany
    {
        return $this->hasMany(UserAssessment::class);
    }
}
