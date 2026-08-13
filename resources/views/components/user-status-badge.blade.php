@props([
    'status',
    'label' => null,
])

@php
    $styles = [
        'active' => 'feedback-badge--excellent',
        'inactive' => 'feedback-badge--bad',
    ];

    $class = $styles[$status] ?? 'feedback-badge--muted';
    $text = $label ?? \App\Models\User::statusLabels()[$status] ?? ucfirst((string) $status);
@endphp

<span {{ $attributes->merge(['class' => "feedback-badge {$class}"]) }}>
    {{ $text }}
</span>
