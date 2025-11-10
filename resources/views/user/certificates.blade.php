<x-layouts.user-dashboard>
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Certificates</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for($i = 0; $i < 6; $i++)
            <x-card class="text-center hover:shadow-lg transition-shadow cursor-pointer">
                <div class="w-24 h-24 bg-gradient-to-br from-primary-500 to-secondary-500 rounded-lg mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">English Grammar Fundamentals</h3>
                <p class="text-sm text-gray-500 mb-4">Completed on March 15, 2024</p>
                <div class="flex gap-2 justify-center">
                    <x-button variant="outline" size="sm">View</x-button>
                    <x-button variant="primary" size="sm">Download</x-button>
                </div>
            </x-card>
            @endfor
        </div>
    </div>
</x-layouts.user-dashboard>

