<x-layouts.user-dashboard>
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Courses</h1>

        <!-- Filter Tabs -->
        <div class="flex space-x-4 mb-6 border-b border-gray-200">
            <button class="px-4 py-2 border-b-2 border-primary-600 text-primary-600 font-medium">All Courses</button>
            <button class="px-4 py-2 text-gray-600 hover:text-gray-900">In Progress</button>
            <button class="px-4 py-2 text-gray-600 hover:text-gray-900">Completed</button>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for($i = 0; $i < 9; $i++)
            <x-course-card 
                :course="(object)[
                    'title' => 'English Grammar Fundamentals',
                    'description' => 'Master the basics of English grammar with interactive lessons and exercises.',
                    'lessons_count' => 25,
                    'duration' => '6 weeks',
                    'level' => 'Beginner',
                    'progress' => rand(20, 90)
                ]"
                :showProgress="true"
            />
            @endfor
        </div>
    </div>
</x-layouts.user-dashboard>

