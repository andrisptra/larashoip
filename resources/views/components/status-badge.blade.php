@props(['status'])

@php
    $classes = match ($status) {
        'completed' => 'bg-green-50 text-green-700 ring-green-600/20',
        'pending' => 'bg-yellow-50 text-yellow-700 ring-yellow-600/20',
        default => 'bg-red-50 text-red-700 ring-red-600/20',
    };
@endphp

<span
    {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-2 py-1 text-xs font-medium ring-1 ring-inset $classes"]) }}>
    {{ ucfirst($status) }}
</span>
