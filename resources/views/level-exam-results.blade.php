<x-layouts.app>
    <div>
        <!-- Header -->
        <section class="bg-gradient-to-br from-primary-600 to-secondary-600 text-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold mb-4">Level {{ $userExam->level }} Exam Results</h1>
                <p class="text-xl text-primary-100">Your exam has been completed</p>
            </div>
        </section>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Score Card -->
            <x-card class="mb-8 text-center">
                <h2 class="text-2xl font-bold mb-4">Your Score</h2>
                <div class="text-5xl font-bold {{ $userExam->passed ? 'text-green-600' : 'text-red-600' }} mb-2">
                    {{ $userExam->score }} / {{ $userExam->max_score }}
                </div>
                <div class="text-xl text-gray-600 mb-6">{{ round($userExam->percentage, 1) }}%</div>
                <x-progress-bar :value="$userExam->percentage" :max="100" :color="$userExam->passed ? 'success' : 'error'" :showLabel="true" />
                @if($userExam->passed)
                <div class="mt-4 inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-semibold">Passed! Level {{ $userExam->level }} Unlocked</span>
                </div>
                @else
                <div class="mt-4 inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="font-semibold">Not Passed (Required: {{ $userExam->levelExam->passing_percentage }}%)</span>
                </div>
                @endif
            </x-card>

            @if($userExam->passed)
            <!-- Unlocked Level Info -->
            <x-card class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Congratulations!</h2>
                <p class="text-lg text-gray-700 mb-4">
                    You have successfully unlocked <strong>Level {{ $userExam->level }}</strong>. 
                    You can now access all courses and content for this level.
                </p>
                <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    Go to Dashboard
                </a>
            </x-card>
            @else
            <!-- Retry Option -->
            <x-card class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Keep Learning</h2>
                <p class="text-lg text-gray-700 mb-4">
                    You need to score at least {{ $userExam->levelExam->passing_percentage }}% to unlock Level {{ $userExam->level }}. 
                    Keep practicing and try again!
                </p>
                <a href="{{ route('level-exam.start', $userExam->level) }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    Retry Exam
                </a>
            </x-card>
            @endif
        </div>
    </div>
</x-layouts.app>

