<x-layouts.user-dashboard>
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Welcome back, {{ auth()->user()->name ?? 'Student' }}!</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <x-card>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">5</div>
                        <div class="text-sm text-gray-600">Active Courses</div>
                    </div>
                </div>
            </x-card>
            <x-card>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">42</div>
                        <div class="text-sm text-gray-600">Completed Lessons</div>
                    </div>
                </div>
            </x-card>
            <x-card>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">12h</div>
                        <div class="text-sm text-gray-600">Study Time</div>
                    </div>
                </div>
            </x-card>
            <x-card>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-900">3</div>
                        <div class="text-sm text-gray-600">Certificates</div>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Active Courses -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Continue Learning</h2>
                <a href="{{ route('user.my-courses') }}" class="text-primary-600 hover:text-primary-700">View all</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for($i = 0; $i < 3; $i++)
                <x-course-card 
                    :course="(object)[
                        'title' => 'English Grammar Fundamentals',
                        'description' => 'Master the basics of English grammar with interactive lessons.',
                        'lessons_count' => 25,
                        'duration' => '6 weeks',
                        'level' => 'Beginner',
                        'progress' => 65
                    ]"
                    :showProgress="true"
                />
                @endfor
            </div>
        </div>

        <!-- Recent Activity -->
        <x-card>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Recent Activity</h2>
            <div class="space-y-4">
                @for($i = 0; $i < 5; $i++)
                <div class="flex items-center pb-4 border-b border-gray-200 last:border-0 last:pb-0">
                    <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium text-gray-900">Completed lesson: Grammar Basics</div>
                        <div class="text-sm text-gray-500">2 hours ago</div>
                    </div>
                </div>
                @endfor
            </div>
        </x-card>
    </div>
</x-layouts.user-dashboard>

