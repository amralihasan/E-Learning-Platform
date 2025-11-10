<x-layouts.user-dashboard>
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Progress</h1>

        <!-- Overall Progress -->
        <x-card class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Overall Progress</h2>
            <div class="mb-6">
                <x-progress-bar :value="68" :max="100" color="primary" :showLabel="true" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <div class="text-3xl font-bold text-primary-600 mb-2">68%</div>
                    <div class="text-gray-600">Overall Completion</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-green-600 mb-2">42</div>
                    <div class="text-gray-600">Lessons Completed</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-yellow-600 mb-2">12h</div>
                    <div class="text-gray-600">Total Study Time</div>
                </div>
            </div>
        </x-card>

        <!-- Course Progress -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Course Progress</h2>
            <div class="space-y-4">
                @for($i = 0; $i < 5; $i++)
                <x-card>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold">English Grammar Fundamentals</h3>
                            <p class="text-sm text-gray-500">25 lessons total</p>
                        </div>
                        <x-badge variant="primary">{{ rand(40, 90) }}%</x-badge>
                    </div>
                    <x-progress-bar :value="rand(40, 90)" :max="100" color="primary" />
                </x-card>
                @endfor
            </div>
        </div>

        <!-- Study Streak -->
        <x-card class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Study Streak</h2>
            <div class="text-center">
                <div class="text-5xl font-bold text-primary-600 mb-2">7</div>
                <div class="text-gray-600 mb-6">Days in a row</div>
                <div class="flex justify-center gap-2">
                    @for($i = 1; $i <= 7; $i++)
                    <div class="w-12 h-12 rounded-lg {{ $i <= 7 ? 'bg-green-500' : 'bg-gray-200' }} flex items-center justify-center text-white font-bold">
                        {{ $i }}
                    </div>
                    @endfor
                </div>
            </div>
        </x-card>

        <!-- Achievements -->
        <x-card>
            <h2 class="text-2xl font-bold mb-6">Achievements</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @for($i = 0; $i < 6; $i++)
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-1">First Steps</h3>
                    <p class="text-sm text-gray-500">Complete your first lesson</p>
                </div>
                @endfor
            </div>
        </x-card>
    </div>
</x-layouts.user-dashboard>

