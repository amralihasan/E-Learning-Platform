<div>
    <!-- Header Section -->
        <section class="bg-gradient-to-br from-primary-600 to-secondary-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-bold mb-4">Browse Courses</h1>
                <p class="text-xl text-primary-100">Find the perfect course to start your English learning journey</p>
            </div>
        </section>

        <!-- Filters and Search -->
        <section class="bg-white border-b py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input 
                            type="text" 
                            placeholder="Search courses..." 
                            wire:model.live="search"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        >
                    </div>
                    <select wire:model.live="level" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="">All Levels</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
                    <select wire:model.live="category" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        <option value="">All Categories</option>
                        <option value="grammar">Grammar</option>
                        <option value="vocabulary">Vocabulary</option>
                        <option value="speaking">Speaking</option>
                        <option value="writing">Writing</option>
                    </select>
                    <div class="flex gap-2">
                        <button 
                            wire:click="$set('view', 'grid')"
                            class="px-4 py-2 border border-gray-300 rounded-lg {{ $view === 'grid' ? 'bg-primary-600 text-white' : 'bg-white' }}"
                        >
                            Grid
                        </button>
                        <button 
                            wire:click="$set('view', 'list')"
                            class="px-4 py-2 border border-gray-300 rounded-lg {{ $view === 'list' ? 'bg-primary-600 text-white' : 'bg-white' }}"
                        >
                            List
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Courses Grid -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($view === 'grid')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @for($i = 0; $i < 9; $i++)
                    <x-course-card 
                        :course="(object)[
                            'title' => 'English Grammar Fundamentals',
                            'description' => 'Master the basics of English grammar with interactive lessons and exercises.',
                            'lessons_count' => 25,
                            'duration' => '6 weeks',
                            'level' => 'Beginner'
                        ]"
                    />
                    @endfor
                </div>
                @else
                <div class="space-y-4">
                    @for($i = 0; $i < 9; $i++)
                    <x-card class="flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-64 h-48 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-lg"></div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-xl font-semibold">English Grammar Fundamentals</h3>
                                <x-badge variant="primary">Beginner</x-badge>
                            </div>
                            <p class="text-gray-600 mb-4">Master the basics of English grammar with interactive lessons and exercises.</p>
                            <div class="flex items-center gap-6 text-sm text-gray-500 mb-4">
                                <span>25 Lessons</span>
                                <span>6 Weeks</span>
                                <span>4.5 ⭐</span>
                            </div>
                            <x-button variant="primary">View Course</x-button>
                        </div>
                    </x-card>
                    @endfor
                </div>
                @endif

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Previous</button>
                        <button class="px-4 py-2 bg-primary-600 text-white rounded-lg">1</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">2</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">3</button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Next</button>
                    </div>
                </div>
            </div>
        </section>
</div>
