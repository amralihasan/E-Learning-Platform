@props(['course', 'showProgress' => false])

<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
    <div class="h-48 bg-gradient-to-br from-primary-500 to-secondary-500 relative">
        @if(isset($course->image))
        <img src="{{ $course->image }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
        @endif
        @if(isset($course->level))
        <div class="absolute top-4 right-4">
            <x-badge variant="primary" size="sm">{{ $course->level }}</x-badge>
        </div>
        @endif
    </div>
    <div class="p-6">
        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $course->title ?? 'Course Title' }}</h3>
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $course->description ?? 'Course description goes here...' }}</p>
        
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                {{ $course->lessons_count ?? 0 }} Lessons
            </div>
            <div class="text-sm font-semibold text-primary-600">
                {{ $course->duration ?? 'N/A' }}
            </div>
        </div>
        
        @if($showProgress && isset($course->progress))
        <x-progress-bar :value="$course->progress" :max="100" color="primary" class="mb-4" />
        @endif
        
        <x-button variant="primary" class="w-full">
            {{ $showProgress && isset($course->progress) ? 'Continue Learning' : 'Enroll Now' }}
        </x-button>
    </div>
</div>

