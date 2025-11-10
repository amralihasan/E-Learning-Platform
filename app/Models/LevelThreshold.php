<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelThreshold extends Model
{
    protected $fillable = [
        'level',
        'min_percentage',
        'max_percentage',
        'order',
        'is_active',
    ];

    protected $casts = [
        'min_percentage' => 'decimal:2',
        'max_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public static function getLevelsForPercentage($percentage)
    {
        return static::where('is_active', true)
            ->where('min_percentage', '<=', $percentage)
            ->orderBy('order')
            ->pluck('level')
            ->toArray();
    }
}
