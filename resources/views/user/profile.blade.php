<x-layouts.user-dashboard>
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Profile Settings</h1>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Information -->
            <div class="lg:col-span-2">
                <x-card class="mb-6">
                    <h2 class="text-xl font-semibold mb-6">Personal Information</h2>
                    <form class="space-y-6">
                        <div class="flex items-center mb-6">
                            <div class="w-20 h-20 rounded-full bg-primary-500 flex items-center justify-center text-white text-2xl font-bold mr-4">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <x-button variant="outline" size="sm">Change Photo</x-button>
                                <p class="text-sm text-gray-500 mt-2">JPG, PNG or GIF. Max size 2MB</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input label="First Name" value="{{ auth()->user()->name ?? '' }}" />
                            <x-input label="Last Name" value="" />
                            <x-input type="email" label="Email" value="{{ auth()->user()->email ?? '' }}" />
                            <x-input type="tel" label="Phone" value="" />
                        </div>
                        <x-button variant="primary" size="lg">Save Changes</x-button>
                    </form>
                </x-card>

                <x-card class="mb-6">
                    <h2 class="text-xl font-semibold mb-6">Change Password</h2>
                    <form class="space-y-6">
                        <x-input type="password" label="Current Password" />
                        <x-input type="password" label="New Password" />
                        <x-input type="password" label="Confirm New Password" />
                        <x-button variant="primary" size="lg">Update Password</x-button>
                    </form>
                </x-card>

                <x-card>
                    <h2 class="text-xl font-semibold mb-6">Notification Preferences</h2>
                    <div class="space-y-4">
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-3 text-gray-700">Email notifications</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" checked class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-3 text-gray-700">Course updates</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-3 text-gray-700">Marketing emails</span>
                        </label>
                    </div>
                    <x-button variant="primary" size="lg" class="mt-6">Save Preferences</x-button>
                </x-card>
            </div>

            <!-- Account Summary -->
            <div>
                <x-card>
                    <h2 class="text-xl font-semibold mb-6">Account Summary</h2>
                    <div class="space-y-4">
                        <div>
                            <div class="text-sm text-gray-500">Member since</div>
                            <div class="font-semibold">March 2024</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Total courses</div>
                            <div class="font-semibold">5 courses</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Certificates earned</div>
                            <div class="font-semibold">3 certificates</div>
                        </div>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</x-layouts.user-dashboard>

