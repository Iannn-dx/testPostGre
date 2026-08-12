@props([
    'experience',
    'label' => null,
])

@php
    $styles = [
        'excellent' => 'feedback-badge--excellent',
        'good' => 'feedback-badge--good',
        'average' => 'feedback-badge--average',
        'poor' => 'feedback-badge--poor',
        'bad' => 'feedback-badge--bad',
    ];

    $class = $styles[$experience] ?? 'feedback-badge--muted';
    $text = $label ?? \App\Models\Feedback::experienceLabels()[$experience] ?? 'Unknown';
@endphp

<span {{ $attributes->merge(['class' => "feedback-badge {$class}"]) }}>
    {{ $text }}
</span>
