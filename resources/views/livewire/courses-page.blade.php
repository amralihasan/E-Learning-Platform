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
                        @foreach(['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $lvl)
                        <option value="{{ $lvl }}" {{ in_array($lvl, $unlockedLevels) ? '' : 'disabled' }}>{{ $lvl }}{{ !in_array($lvl, $unlockedLevels) ? ' (Locked)' : '' }}</option>
                        @endforeach
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
                @if(count($courses) > 0)
                @if($view === 'grid')
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                    <x-course-card 
                        :course="(object)[
                            'id' => $course->id,
                            'title' => $course->title,
                            'description' => $course->description,
                            'lessons_count' => $course->lessons->count(),
                            'duration' => $course->duration_weeks . ' weeks',
                            'level' => $course->level
                        ]"
                    />
                    @endforeach
                </div>
                @else
                <div class="space-y-4">
                    @foreach($courses as $course)
                    <x-card class="flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-64 h-48 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-lg">
                            @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-full object-cover rounded-lg">
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="text-xl font-semibold">{{ $course->title }}</h3>
                                <x-badge variant="primary">{{ $course->level }}</x-badge>
                            </div>
                            <p class="text-gray-600 mb-4">{{ $course->description }}</p>
                            <div class="flex items-center gap-6 text-sm text-gray-500 mb-4">
                                <span>{{ $course->lessons->count() }} Lessons</span>
                                <span>{{ $course->duration_weeks }} Weeks</span>
                            </div>
                            <x-button variant="primary" href="{{ route('course.details', $course->id) }}">View Course</x-button>
                        </div>
                    </x-card>
                    @endforeach
                </div>
                @endif
                @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg mb-4">No courses available for your unlocked levels.</p>
                    @if(auth()->check() && count($unlockedLevels) === 0)
                    <p class="text-gray-400">Complete the assessment to unlock levels and access courses.</p>
                    <a href="{{ route('choose-starting-point') }}" class="inline-block mt-4 px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                        Take Assessment
                    </a>
                    @endif
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
