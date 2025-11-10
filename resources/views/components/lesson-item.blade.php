@props(['lesson', 'isCompleted' => false, 'isActive' => false])

@php
$baseClasses = 'flex items-center p-4 border rounded-lg transition-colors';
$activeClasses = $isActive ? 'border-primary-500 bg-primary-50' : 'border-gray-200 hover:border-gray-300';
$completedClasses = $isCompleted ? 'opacity-75' : '';
@endphp

<div {{ $attributes->merge(['class' => "{$baseClasses} {$activeClasses} {$completedClasses}"]) }}>
    <div class="flex-shrink-0 mr-4">
        @if($isCompleted)
        <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        @else
        <div class="w-8 h-8 rounded-full {{ $isActive ? 'bg-primary-500' : 'bg-gray-300' }} flex items-center justify-center">
            <span class="text-sm font-semibold {{ $isActive ? 'text-white' : 'text-gray-600' }}">
                {{ $lesson->order ?? '1' }}
            </span>
        </div>
        @endif
    </div>
    <div class="flex-1">
        <h4 class="font-medium text-gray-900">{{ $lesson->title ?? 'Lesson Title' }}</h4>
        <p class="text-sm text-gray-500 mt-1">{{ $lesson->duration ?? '5 min' }}</p>
    </div>
    @if(isset($lesson->type))
    <div class="flex-shrink-0 ml-4">
        <x-badge variant="secondary" size="sm">{{ $lesson->type }}</x-badge>
    </div>
    @endif
</div>

