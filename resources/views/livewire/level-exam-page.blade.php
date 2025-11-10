<div>
    <!-- Header -->
    <div class="bg-white border-b sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold text-gray-900">Level {{ $level }} Exam</h1>
                <div class="text-sm text-gray-600">
                    Question {{ $currentQuestionIndex + 1 }} of {{ count($currentQuestions) }} ({{ ucfirst($currentSection) }})
                </div>
            </div>
            <x-progress-bar :value="$this->progress" :max="100" color="primary" :showLabel="true" />
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
                {{ ucfirst($section) }}
            </button>
            @endforeach
        </div>

        @if($currentQuestion)
        <x-card>
            <!-- Reading Passage (if reading section) -->
            @if($currentSection === 'reading' && $currentQuestion->reading_passage)
            <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="font-semibold mb-2">Reading Passage:</h3>
                <div class="prose max-w-none">
                    {!! nl2br(e($currentQuestion->reading_passage)) !!}
                </div>
            </div>
            @endif

            <!-- Audio Player (if listening section) -->
            @if($currentSection === 'listening' && $currentQuestion->audio_url)
            <div class="mb-6">
                <audio controls class="w-full">
                    <source src="{{ str_starts_with($currentQuestion->audio_url, 'http') ? $currentQuestion->audio_url : asset('storage/' . $currentQuestion->audio_url) }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            @endif

            <!-- Question -->
            <h2 class="text-xl font-semibold mb-6">{{ $currentQuestion->question_text }}</h2>

            <!-- Answers -->
            <div class="space-y-3 mb-8">
                @foreach($currentQuestion->answers as $answer)
                <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-colors {{ isset($answers[$currentQuestion->id]) && $answers[$currentQuestion->id] == $answer->id ? 'border-primary-500 bg-primary-50' : 'border-gray-200 hover:border-gray-300' }}">
                    <input 
                        type="radio" 
                        name="question_{{ $currentQuestion->id }}" 
                        value="{{ $answer->id }}"
                        wire:click="selectAnswer({{ $currentQuestion->id }}, {{ $answer->id }})"
                        {{ isset($answers[$currentQuestion->id]) && $answers[$currentQuestion->id] == $answer->id ? 'checked' : '' }}
                        class="mt-1 mr-3"
                    >
                    <span class="flex-1">{{ $answer->answer_text }}</span>
                </label>
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between">
                @if($currentQuestionIndex === 0 && $currentSection === 'reading')
                <x-button variant="outline" disabled>
                    Previous
                </x-button>
                @else
                <x-button variant="outline" wire:click="previousQuestion">
                    Previous
                </x-button>
                @endif
                
                @if($currentQuestionIndex === count($currentQuestions) - 1 && $currentSection === 'grammar')
                <x-button variant="primary" wire:click="submitExam">
                    Submit Exam
                </x-button>
                @else
                <x-button variant="primary" wire:click="nextQuestion">
                    Next
                </x-button>
                @endif
            </div>
        </x-card>
        @endif
    </div>
</div>
