@props(['variant' => 'primary', 'size' => 'md', 'type' => 'button'])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
$variantClasses = [
    'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
    'secondary' => 'bg-secondary-600 text-white hover:bg-secondary-700 focus:ring-secondary-500',
    'outline' => 'border-2 border-primary-600 text-primary-600 hover:bg-primary-50 focus:ring-primary-500',
    'ghost' => 'text-primary-600 hover:bg-primary-50 focus:ring-primary-500',
    'danger' => 'bg-error-600 text-white hover:bg-error-700 focus:ring-error-500',
];
$sizeClasses = [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-base',
    'lg' => 'px-6 py-3 text-lg',
];
$classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
$tag = $attributes->has('href') ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $tag === 'button' ? 'type="' . $type . '"' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</{{ $tag }}>

