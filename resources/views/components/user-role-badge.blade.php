@props([
    'role',
    'label' => null,
])

@php
    $styles = [
        'admin' => 'feedback-badge--good',
        'staff' => 'feedback-badge--muted',
    ];

    $class = $styles[$role] ?? 'feedback-badge--muted';
    $text = $label ?? \App\Models\User::roleLabels()[$role] ?? 'Staff';
@endphp

<span {{ $attributes->merge(['class' => "feedback-badge {$class}"]) }}>
    {{ $text }}
</span>
