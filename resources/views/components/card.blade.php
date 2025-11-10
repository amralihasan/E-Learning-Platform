@props(['padding' => 'p-6', 'shadow' => 'shadow-md'])

<div {{ $attributes->merge(['class' => "bg-white rounded-lg border border-gray-200 {$shadow} {$padding}"]) }}>
    {{ $slot }}
</div>

