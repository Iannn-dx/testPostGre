@props([
    'type' => 'success',
    'message' => '',
])

@php
    $styles = match ($type) {
        'error' => 'border-red-200 bg-red-50 text-red-800',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-900',
        default => 'border-emerald-200 bg-emerald-50 text-emerald-800',
    };

    $icon = match ($type) {
        'error' => 'circle-alert',
        default => 'circle-check',
    };
@endphp

<div {{ $attributes->merge(['class' => "flex items-start gap-3 rounded-lg border px-4 py-3 text-sm {$styles}"]) }}
    role="{{ $type === 'error' ? 'alert' : 'status' }}">
    <x-lucide-icon :name="$icon" class="mt-0.5 h-4 w-4 shrink-0" />
    <p>{{ $message }}</p>
</div>
