<x-layouts.app>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Reset password</h2>
            </div>
            <x-card>
                <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <x-input 
                        type="email" 
                        name="email" 
                        label="Email address" 
                        value="{{ old('email', $email) }}"
                        required 
                        autofocus
                    />
                    @error('email')
                        <p class="text-error-600 text-sm">{{ $message }}</p>
                    @enderror

                    <x-input 
                        type="password" 
                        name="password" 
                        label="New password" 
                        required
                    />
                    @error('password')
                        <p class="text-error-600 text-sm">{{ $message }}</p>
                    @enderror

                    <x-input 
                        type="password" 
                        name="password_confirmation" 
                        label="Confirm new password" 
                        required
                    />

                    <x-button variant="primary" size="lg" type="submit" class="w-full">
                        Reset password
                    </x-button>
                </form>
            </x-card>
        </div>
    </div>
</x-layouts.app>

