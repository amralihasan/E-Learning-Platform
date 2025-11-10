<div>
    <!-- Course Header -->
        <section class="bg-gradient-to-br from-primary-600 to-secondary-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <x-badge variant="secondary" size="lg" class="mb-4">Beginner Level</x-badge>
                <h1 class="text-4xl md:text-5xl font-bold mb-4">English Grammar Fundamentals</h1>
                <p class="text-xl text-primary-100 mb-6">Master the basics of English grammar with interactive lessons and exercises designed for beginners.</p>
                <div class="flex flex-wrap gap-6 text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        25 Lessons
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        6 Weeks
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        4.5 (120 reviews)
                    </div>
                </div>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <!-- Course Overview -->
                    <x-card class="mb-8">
                        <h2 class="text-2xl font-bold mb-4">Course Overview</h2>
                        <p class="text-gray-600 mb-4">
                            This comprehensive course is designed for beginners who want to master English grammar. 
                            You'll learn the fundamental rules and structures that form the foundation of the English language.
                        </p>
                        <p class="text-gray-600">
                            Through interactive lessons, practical exercises, and real-world examples, you'll gain 
                            confidence in using English grammar correctly in both written and spoken communication.
                        </p>
                    </x-card>

                    <!-- Curriculum -->
                    <x-card class="mb-8">
                        <h2 class="text-2xl font-bold mb-6">Curriculum</h2>
                        <div class="space-y-3">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="border-l-4 border-primary-500 pl-4">
                                <h3 class="font-semibold text-lg mb-2">Module {{ $i }}: Introduction to Grammar</h3>
                                <p class="text-gray-600 text-sm mb-3">Learn the basics of English grammar structures</p>
                                <div class="space-y-2">
                                    @for($j = 1; $j <= 3; $j++)
                                    <x-lesson-item 
                                        :lesson="(object)[
                                            'title' => 'Lesson ' . (($i-1)*3 + $j) . ': Grammar Basics',
                                            'duration' => '15 min',
                                            'order' => ($i-1)*3 + $j,
                                            'type' => 'Video'
                                        ]"
                                        :isCompleted="$j === 1"
                                        :isActive="$i === 1 && $j === 2"
                                    />
                                    @endfor
                                </div>
                            </div>
                            @endfor
                        </div>
                    </x-card>

                    <!-- Reviews -->
                    <x-card>
                        <h2 class="text-2xl font-bold mb-6">Student Reviews</h2>
                        <div class="space-y-6">
                            @for($i = 0; $i < 3; $i++)
                            <div class="border-b border-gray-200 pb-6 last:border-0">
                                <div class="flex items-center mb-2">
                                    <div class="w-10 h-10 rounded-full bg-primary-500 flex items-center justify-center text-white font-bold mr-3">
                                        U
                                    </div>
                                    <div>
                                        <div class="font-semibold">Student Name</div>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <span class="text-yellow-400">★★★★★</span>
                                            <span class="ml-2">2 days ago</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-600">"This course has been incredibly helpful. The lessons are well-structured and easy to follow."</p>
                            </div>
                            @endfor
                        </div>
                    </x-card>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <x-card class="sticky top-4">
                        <div class="text-center mb-6">
                            <div class="text-3xl font-bold text-primary-600 mb-2">$49</div>
                            <div class="text-gray-500 line-through">$99</div>
                        </div>
                        <x-button variant="primary" size="lg" class="w-full mb-4">
                            Enroll Now
                        </x-button>
                        <x-button variant="outline" size="lg" class="w-full mb-6">
                            Add to Wishlist
                        </x-button>
                        <div class="space-y-4 text-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Lifetime access
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Certificate of completion
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                30-day money-back guarantee
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="font-semibold mb-3">Instructor</h3>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-primary-500 flex items-center justify-center text-white font-bold mr-3">
                                    JD
                                </div>
                                <div>
                                    <div class="font-semibold">John Doe</div>
                                    <div class="text-sm text-gray-500">English Teacher</div>
                                </div>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>
        </div>
</div>
