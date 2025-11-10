<x-layouts.user-dashboard>
    <div>
        <!-- Course Header -->
        <div class="bg-gradient-to-br from-primary-600 to-secondary-600 text-white rounded-lg p-8 mb-8">
            <h1 class="text-3xl font-bold mb-4">English Grammar Fundamentals</h1>
            <p class="text-primary-100 mb-6">Master the basics of English grammar with interactive lessons</p>
            <x-progress-bar :value="65" :max="100" color="primary" :showLabel="true" />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Lesson Sidebar -->
            <div class="lg:col-span-1">
                <x-card>
                    <h2 class="text-lg font-semibold mb-4">Course Content</h2>
                    <div class="space-y-2">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="border-l-4 {{ $i === 2 ? 'border-primary-500 bg-primary-50' : 'border-gray-200' }} pl-4 py-2">
                            <div class="font-medium text-sm">Module {{ $i }}</div>
                            <div class="text-xs text-gray-500">5 lessons</div>
                        </div>
                        @endfor
                    </div>
                </x-card>
            </div>

            <!-- Lesson Content -->
            <div class="lg:col-span-3">
                <x-card>
                    <div class="mb-6">
                        <x-badge variant="primary" class="mb-4">Lesson 2 of 25</x-badge>
                        <h2 class="text-2xl font-bold mb-4">Introduction to Verbs</h2>
                    </div>

                    <!-- Video Player Placeholder -->
                    <div class="bg-gray-900 aspect-video rounded-lg mb-6 flex items-center justify-center">
                        <div class="text-white text-center">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                            </svg>
                            <p>Video Player</p>
                        </div>
                    </div>

                    <!-- Lesson Description -->
                    <div class="prose max-w-none mb-6">
                        <p class="text-gray-600">
                            In this lesson, you'll learn about verbs - one of the most important parts of speech in English. 
                            We'll cover different types of verbs, their forms, and how to use them correctly in sentences.
                        </p>
                    </div>

                    <!-- Exercises -->
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h3 class="text-lg font-semibold mb-4">Practice Exercises</h3>
                        <div class="space-y-4">
                            @for($i = 1; $i <= 3; $i++)
                            <x-card padding="p-4" shadow="shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-medium">Exercise {{ $i }}</h4>
                                        <p class="text-sm text-gray-500">Complete the sentences with the correct verb form</p>
                                    </div>
                                    <x-button variant="outline" size="sm">Start</x-button>
                                </div>
                            </x-card>
                            @endfor
                        </div>
                    </div>

                    <!-- Notes Section -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold mb-4">My Notes</h3>
                        <textarea 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            rows="4"
                            placeholder="Add your notes here..."
                        ></textarea>
                    </div>

                    <!-- Navigation -->
                    <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                        <x-button variant="outline">Previous Lesson</x-button>
                        <x-button variant="primary">Next Lesson</x-button>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</x-layouts.user-dashboard>

