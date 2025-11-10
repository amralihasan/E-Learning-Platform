@props(['value' => 0, 'max' => 100, 'color' => 'primary', 'showLabel' => false])

@php
$percentage = min(100, max(0, ($value / $max) * 100));
$colorClasses = [
    'primary' => 'bg-primary-600',
    'secondary' => 'bg-secondary-600',
    'success' => 'bg-green-600',
    'warning' => 'bg-yellow-600',
    'danger' => 'bg-red-600',
];
$barColor = $colorClasses[$color] ?? $colorClasses['primary'];
@endphp

<div class="w-full">
    @if($showLabel)
    <div class="flex justify-between mb-1">
        <span class="text-sm font-medium text-gray-700">Progress</span>
        <span class="text-sm font-medium text-gray-700">{{ round($percentage) }}%</span>
    </div>
    @endif
    <div class="w-full bg-gray-200 rounded-full h-2.5">
        <div 
            class="{{ $barColor }} h-2.5 rounded-full transition-all duration-300"
            style="width: {{ $percentage }}%"
        ></div>
    </div>
</div>

