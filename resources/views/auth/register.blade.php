<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Create your account</h2>
                <p class="mt-2 text-gray-600">Or <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-500">sign in to existing account</a></p>
            </div>
            <x-card>
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf
                    <x-input 
                        type="text" 
                        name="name" 
                        label="Full name" 
                        value="{{ old('name') }}"
                        required 
                        autofocus
                    />
                    @error('name')
                        <p class="text-error-600 text-sm">{{ $message }}</p>
                    @enderror

                    <x-input 
                        type="email" 
                        name="email" 
                        label="Email address" 
                        value="{{ old('email') }}"
                        required
                    />
                    @error('email')
                        <p class="text-error-600 text-sm">{{ $message }}</p>
                    @enderror

                    <x-input 
                        type="password" 
                        name="password" 
                        label="Password" 
                        required
                    />
                    @error('password')
                        <p class="text-error-600 text-sm">{{ $message }}</p>
                    @enderror

                    <x-input 
                        type="password" 
                        name="password_confirmation" 
                        label="Confirm password" 
                        required
                    />

                    <div class="flex items-center">
                        <input type="checkbox" name="terms" required class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                        <label class="ml-2 text-sm text-gray-600">
                            I agree to the <a href="#" class="text-primary-600 hover:text-primary-500">Terms and Conditions</a>
                        </label>
                    </div>

                    <x-button variant="primary" size="lg" type="submit" class="w-full">
                        Create account
                    </x-button>
                </form>
            </x-card>
        </div>
    </div>
</x-layouts.app>

