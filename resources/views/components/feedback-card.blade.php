@props([
    'rating',
    'comment',
    'author',
    'date',
])

<article {{ $attributes->merge(['class' => 'rounded-lg border border-neutral-100 bg-neutral-50/60 p-4']) }}>
    <div class="flex gap-0.5 text-amber-500" aria-label="{{ $rating }} out of 5 stars">
        @for ($i = 1; $i <= 5; $i++)
            <x-lucide-icon name="star"
                class="h-4 w-4 {{ $i <= $rating ? 'fill-amber-400 text-amber-400' : 'text-neutral-300' }}" />
        @endfor
    </div>

    <blockquote class="mt-3 text-sm leading-relaxed text-neutral-700">
        &ldquo;{{ $comment }}&rdquo;
    </blockquote>

    <footer class="mt-3 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-neutral-500">
        <span class="font-medium text-neutral-600">{{ $author }}</span>
        <span aria-hidden="true">&middot;</span>
        <time>{{ $date }}</time>
    </footer>
</article>
