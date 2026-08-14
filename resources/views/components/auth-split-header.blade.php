@props(['title', 'description'])

<div class="auth-brand">
    <a href="{{ route('home') }}" class="auth-brand__link">
        <div class="feedback-logo">
            <img src="{{ asset('assets/images/OIP.png') }}" alt="Cagayan Museum logo" class="feedback-logo__image">
        </div>
        <div>
            <p class="auth-brand__eyebrow">Cagayan Museum</p>
            <p class="auth-brand__name">Portal</p>
        </div>
    </a>
</div>      

<div class="auth-heading">
    <h1 class="auth-heading__title">{{ $title }}</h1>
    <p class="auth-heading__description">{{ $description }}</p>
</div>
