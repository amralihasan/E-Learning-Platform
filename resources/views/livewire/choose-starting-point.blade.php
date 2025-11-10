<div>
    <!-- Header Section -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-serif text-gray-900 mb-6">Choose Your Starting Point</h1>
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Welcome to your personalized English learning journey! To ensure you get the most out of our resources, 
                        we offer two paths to begin with. You can either assess your current English level to find a tailored 
                        starting point or dive right into learning from Level A1. Select the option that best suits your needs 
                        and start mastering English today!
                    </p>
                </div>
                <div class="flex justify-center lg:justify-end">
                    <div class="relative">
                        <div class="w-32 h-32 bg-orange-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-orange-400 w-8 h-8 rounded-full"></div>
                    </div>
                    <div class="ml-4 flex flex-col justify-center">
                        <div class="text-2xl font-bold text-orange-500">English</div>
                        <div class="text-2xl font-bold text-orange-500">Pathway</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Choice Cards Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Assess My English Level Card -->
                <x-card class="bg-white text-gray-900 border-2 border-gray-200 hover:shadow-xl transition-shadow cursor-pointer">
                    <div class="h-full flex flex-col">
                        <h2 class="text-3xl font-bold mb-4">Assess My English Level</h2>
                        <p class="text-gray-700 mb-8 flex-grow">
                            Not sure where to start? Take our quick assessment to find the perfect starting point for your English 
                            learning journey. This will help us place you at the right level so you can begin learning effectively right away!
                        </p>
                        <button type="button" wire:click="startAssessment" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 px-6 py-3 text-lg border-2 border-primary-600 text-primary-600 hover:bg-primary-50 w-full md:w-auto">
                            Take Assessment
                        </button>
                    </div>
                </x-card>

                <!-- Start from Level A1 Card -->
                <x-card class="bg-white text-gray-900 border-2 border-gray-200 hover:shadow-xl transition-shadow cursor-pointer">
                    <div class="h-full flex flex-col">
                        <h2 class="text-3xl font-bold mb-4">Start from Level A1</h2>
                        <p class="text-gray-700 mb-8 flex-grow">
                            New to English? No problem! Start your journey from the very beginning with our comprehensive Level A1 
                            courses designed for absolute beginners. Build a strong foundation in English at your own pace and start 
                            speaking with confidence.
                        </p>
                        <button type="button" wire:click="startFromA1" class="inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 px-6 py-3 text-lg border-2 border-primary-600 text-primary-600 hover:bg-primary-50 w-full md:w-auto">
                            Begin at A1
                        </button>
                    </div>
                </x-card>
            </div>
        </div>
    </section>
</div>
