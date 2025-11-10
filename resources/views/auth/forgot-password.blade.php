<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Reset your password</h2>
                <p class="mt-2 text-gray-600">Enter your email address and we'll send you a link to reset your password.</p>
            </div>
            <x-card>
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    <x-input 
                        type="email" 
                        name="email" 
                        label="Email address" 
                        value="{{ old('email') }}"
                        required 
                        autofocus
                    />
                    @error('email')
                        <p class="text-error-600 text-sm">{{ $message }}</p>
                    @enderror

                    <x-button variant="primary" size="lg" type="submit" class="w-full">
                        Send reset link
                    </x-button>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-sm text-primary-600 hover:text-primary-500">
                            Back to login
                        </a>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-layouts.app>

