<div>
    <!-- Header -->
    <div class="bg-white border-b sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $assessment->title }}</h1>
                    <p class="text-sm text-gray-600 mt-1">Preview Mode - Admin View</p>
                </div>
                <div class="text-sm text-gray-600">
                    Total Questions: {{ $assessment->questions->count() }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Section Navigation -->
        <div class="flex justify-center mb-8 space-x-4">
            @foreach($sections as $section)
            <button 
                wire:click="selectSection('{{ $section }}')"
                class="px-6 py-2 rounded-lg font-medium transition-colors {{ $currentSection === $section ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
            >
                {{ ucfirst($section) }} ({{ count($questionsBySection[$section] ?? []) }})
            </button>
            @endforeach
        </div>

        @if(count($currentQuestions) > 0)
        <div class="space-y-6">
            @foreach($currentQuestions as $index => $question)
            <x-card>
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-500">Question {{ $index + 1 }}</span>
                        <span class="text-sm text-gray-500">{{ $question->points }} point(s)</span>
                    </div>
                </div>

                <!-- Reading Passage (if reading section) -->
                @if($currentSection === 'reading' && $question->reading_passage)
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="font-semibold mb-2">Reading Passage:</h3>
                    <div class="prose max-w-none">
                        {!! nl2br(e($question->reading_passage)) !!}
                    </div>
                </div>
                @endif

                <!-- Audio Player (if listening section) -->
                @if($currentSection === 'listening' && $question->audio_url)
                <div class="mb-6">
                    <p class="text-sm text-gray-600 mb-2">Audio File:</p>
                    <audio controls class="w-full">
                        <source src="{{ str_starts_with($question->audio_url, 'http') ? $question->audio_url : asset('storage/' . $question->audio_url) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                @endif

                <!-- Question -->
                <h2 class="text-xl font-semibold mb-6">{{ $question->question_text }}</h2>

                <!-- Answers -->
                <div class="space-y-3">
                    @foreach($question->answers as $answer)
                    <div class="flex items-start p-4 border-2 rounded-lg {{ $answer->is_correct ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                        <div class="flex items-center mr-3">
                            @if($answer->is_correct)
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            @else
                            <div class="w-5 h-5 border-2 border-gray-300 rounded-full"></div>
                            @endif
                        </div>
                        <span class="flex-1 {{ $answer->is_correct ? 'font-semibold text-green-800' : 'text-gray-700' }}">{{ $answer->answer_text }}</span>
                    </div>
                    @endforeach
                </div>
            </x-card>
            @endforeach
        </div>
        @else
        <x-card>
            <div class="text-center py-12">
                <p class="text-gray-500">No questions found in the {{ ucfirst($currentSection) }} section.</p>
            </div>
        </x-card>
        @endif

        <!-- Back to Admin Button -->
        <div class="mt-8 text-center">
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Admin
            </a>
        </div>
    </div>
</div>
