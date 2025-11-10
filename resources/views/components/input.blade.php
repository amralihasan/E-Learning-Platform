@props(['type' => 'text', 'label' => null, 'error' => null])

<div class="mb-4">
    @if($label)
    <label class="block text-sm font-medium text-gray-700 mb-2">
        {{ $label }}
    </label>
    @endif
    <input 
        type="{{ $type }}" 
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors' . ($error ? ' border-error-500' : '')]) }}
    >
    @if($error)
    <p class="mt-1 text-sm text-error-600">{{ $error }}</p>
    @endif
</div>

