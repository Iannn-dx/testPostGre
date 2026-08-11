@props(['title', 'description'])

<div class="auth-stagger-item mb-4">
    <a href="/" class="text-2xl font-bold tracking-light text-red-600">
      {{ config('app.name', 'Visitor Feedback Form') }}
    </a>
</div>

<div class="auth-stagger-item text-left">
  <h1 class="text-2xl font-bold tracking-tight text-black">{{ $title }}</h1>
  <p class="text-sm text-neutral-400">{{ $description }}</p>
</div>
