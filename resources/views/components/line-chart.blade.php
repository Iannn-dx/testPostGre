@props([
    'title',
    'data' => [],
])

@php
    $labels = array_column($data, 'label');
    $values = array_column($data, 'value');
@endphp

<div {{ $attributes->merge(['class' => 'dashboard-chart-card rounded-xl border border-neutral-200 bg-white p-5 shadow-sm']) }}>
    <h3 class="mb-4 text-base font-semibold text-neutral-900">{{ $title }}</h3>

    <div class="relative h-64">
        <canvas
            id="feedback-chart"
            data-labels='@json($labels)'
            data-values='@json($values)'
            aria-label="{{ $title }}"
            role="img"
        ></canvas>
    </div>
</div>
