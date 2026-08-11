@props(['title', 'description'])

<div class="auth-brand">
    <a href="{{ route('home') }}" class="auth-brand__link">
        <div class="auth-brand__logo" aria-hidden="true">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="4" y="18" width="40" height="24" rx="1" stroke="currentColor" stroke-width="1.5" />
                <path d="M4 24h40" stroke="currentColor" stroke-width="1.5" />
                <path d="M14 18V10h6v8M28 18V10h6v8" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" />
                <path d="M10 42v-4M38 42v-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                <circle cx="24" cy="31" r="4" stroke="currentColor" stroke-width="1.5" />
            </svg>
        </div>
        <div>
            <p class="auth-brand__eyebrow">Cagayan Museum</p>
            <p class="auth-brand__name">Staff Portal</p>
        </div>
    </a>
</div>

<div class="auth-heading">
    <h1 class="auth-heading__title">{{ $title }}</h1>
    <p class="auth-heading__description">{{ $description }}</p>
</div>
