@props(['variant' => 'primary', 'size' => 'md'])

@php
$baseClasses = 'inline-flex items-center font-medium rounded-full';
$variantClasses = [
    'primary' => 'bg-primary-100 text-primary-800',
    'secondary' => 'bg-secondary-100 text-secondary-800',
    'success' => 'bg-green-100 text-green-800',
    'warning' => 'bg-yellow-100 text-yellow-800',
    'danger' => 'bg-red-100 text-red-800',
    'gray' => 'bg-gray-100 text-gray-800',
];
$sizeClasses = [
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-2.5 py-1 text-sm',
    'lg' => 'px-3 py-1.5 text-base',
];
$classes = $baseClasses . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>

