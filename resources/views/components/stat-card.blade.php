@props([
    'value',
    'label',
    'change' => null,
    'icon' => 'layout-dashboard',
])

<div {{ $attributes->merge(['class' => 'dashboard-stat-card rounded-xl border border-neutral-200 bg-white p-5 shadow-sm']) }}>
    <div class="flex items-start justify-between gap-3">
        <div class="min-w-0">
            <p class="text-2xl font-semibold tracking-tight text-neutral-900 sm:text-3xl">{{ $value }}</p>
            <p class="mt-1 text-sm font-medium text-neutral-700">{{ $label }}</p>
            @if ($change)
                <p class="mt-2 text-xs text-neutral-500">{{ $change }}</p>
            @endif
        </div>
        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-cm-teal/10 text-cm-teal">
            <x-lucide-icon :name="$icon" class="h-5 w-5" />
        </div>
    </div>
</div>
