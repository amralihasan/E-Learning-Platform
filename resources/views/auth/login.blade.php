<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Sign in to your account</h2>
                <p class="mt-2 text-gray-600">Or <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-500">create a new account</a></p>
            </div>
            <x-card>
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
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

                    <x-input 
                        type="password" 
                        name="password" 
                        label="Password" 
                        required
                    />
                    @error('password')
                        <p class="text-error-600 text-sm">{{ $message }}</p>
                    @enderror

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-500">
                            Forgot password?
                        </a>
                    </div>

                    <x-button variant="primary" size="lg" type="submit" class="w-full">
                        Sign in
                    </x-button>
                </form>
            </x-card>
        </div>
    </div>
</x-layouts.app>

