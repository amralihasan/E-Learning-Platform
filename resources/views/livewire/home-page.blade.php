<div>
    <!-- Hero Section -->
        <section class="bg-gradient-to-br from-primary-600 to-secondary-600 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">Master English with Confidence</h1>
                    <p class="text-xl md:text-2xl mb-8 text-primary-100">Interactive courses designed to help you learn English at your own pace</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <x-button variant="secondary" size="lg" class="bg-white text-primary-600 hover:bg-gray-100">
                            Start Learning Free
                        </x-button>
                        <x-button variant="outline" size="lg" class="border-white text-white hover:bg-white hover:text-primary-600">
                            Browse Courses
                        </x-button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                    <div>
                        <div class="text-4xl font-bold text-primary-600 mb-2">10K+</div>
                        <div class="text-gray-600">Active Students</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-primary-600 mb-2">500+</div>
                        <div class="text-gray-600">Courses Available</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-primary-600 mb-2">50+</div>
                        <div class="text-gray-600">Expert Instructors</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-primary-600 mb-2">95%</div>
                        <div class="text-gray-600">Success Rate</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Courses Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Courses</h2>
                    <p class="text-gray-600">Start your English learning journey with our most popular courses</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @for($i = 0; $i < 6; $i++)
                    <x-course-card 
                        :course="(object)[
                            'title' => 'English for Beginners',
                            'description' => 'Learn the fundamentals of English grammar, vocabulary, and pronunciation.',
                            'lessons_count' => 30,
                            'duration' => '4 weeks',
                            'level' => 'Beginner'
                        ]"
                    />
                    @endfor
                </div>
                <div class="text-center mt-12">
                    <x-button variant="primary" size="lg" href="{{ route('courses') }}">
                        View All Courses
                    </x-button>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">What Our Students Say</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @for($i = 0; $i < 3; $i++)
                    <x-card>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-primary-500 flex items-center justify-center text-white font-bold">
                                U
                            </div>
                            <div class="ml-4">
                                <div class="font-semibold">John Doe</div>
                                <div class="text-sm text-gray-500">Student</div>
                            </div>
                        </div>
                        <p class="text-gray-600">"This platform has transformed my English skills. The courses are well-structured and easy to follow."</p>
                    </x-card>
                    @endfor
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="py-16 bg-primary-600 text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
                <p class="mb-8 text-primary-100">Subscribe to our newsletter for the latest courses and learning tips</p>
                <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white">
                    <x-button variant="secondary" size="lg" class="bg-white text-primary-600 hover:bg-gray-100">
                        Subscribe
                    </x-button>
                </form>
            </div>
        </section>
</div>
