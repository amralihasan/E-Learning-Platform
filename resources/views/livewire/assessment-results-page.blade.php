<div>
    <!-- Header -->
    <section class="bg-gradient-to-br from-primary-600 to-secondary-600 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Assessment Complete!</h1>
            <p class="text-xl text-primary-100">Your English level has been assessed</p>
        </div>
    </section>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Overall Score -->
        <x-card class="mb-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Your Score</h2>
            <div class="text-5xl font-bold text-primary-600 mb-2">
                {{ $userAssessment->score }} / {{ $userAssessment->max_score }}
            </div>
            <div class="text-xl text-gray-600 mb-6">{{ round($percentage) }}%</div>
            <x-progress-bar :value="$percentage" :max="100" color="primary" :showLabel="true" />
        </x-card>

        <!-- Recommended Level -->
        <x-card class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Recommended Level</h2>
            <div class="flex items-center justify-center">
                <div class="text-6xl font-bold text-primary-600 mr-4">{{ $userAssessment->recommended_level }}</div>
                <div>
                    <p class="text-lg text-gray-700">
                        Based on your assessment results, we recommend starting at 
                        <strong>Level {{ $userAssessment->recommended_level }}</strong>.
                    </p>
                    <p class="text-sm text-gray-500 mt-2">
                        This level matches your current English proficiency and will help you progress effectively.
                    </p>
                </div>
            </div>
        </x-card>

        <!-- Unlocked Levels -->
        @php
            $unlockedLevels = auth()->user()->getUnlockedLevelsArray();
        @endphp
        @if(count($unlockedLevels) > 0)
        <x-card class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Unlocked Levels</h2>
            <div class="flex flex-wrap gap-3">
                @foreach(['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $level)
                <div class="px-4 py-2 rounded-lg font-semibold {{ in_array($level, $unlockedLevels) ? 'bg-green-100 text-green-800 border-2 border-green-500' : 'bg-gray-100 text-gray-400 border-2 border-gray-300' }}">
                    {{ $level }}
                    @if(in_array($level, $unlockedLevels))
                    <svg class="inline-block w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @endif
                </div>
                @endforeach
            </div>
            <p class="text-sm text-gray-600 mt-4">
                You can now access courses and content for the unlocked levels above.
            </p>
        </x-card>
        @endif

        <!-- Section Breakdown -->
        <x-card class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Score Breakdown by Section</h2>
            <div class="space-y-6">
                @foreach(['reading', 'listening', 'grammar'] as $section)
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold text-gray-900 capitalize">{{ $section }}</span>
                        <span class="text-gray-600">
                            {{ $sectionScores[$section]['score'] }} / {{ $sectionScores[$section]['max'] }}
                        </span>
                    </div>
                    @php
                        $sectionPercentage = $sectionScores[$section]['max'] > 0 
                            ? ($sectionScores[$section]['score'] / $sectionScores[$section]['max']) * 100 
                            : 0;
                    @endphp
                    <x-progress-bar :value="$sectionPercentage" :max="100" color="primary" />
                </div>
                @endforeach
            </div>
        </x-card>

        <!-- Action Button -->
        <div class="text-center">
            <x-button variant="primary" size="lg" wire:click="startLearning">
                Start Learning at Level {{ $userAssessment->recommended_level }}
            </x-button>
        </div>
    </div>
</div>
