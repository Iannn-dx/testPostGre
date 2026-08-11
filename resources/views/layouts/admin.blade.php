<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard — Cagayan Museum')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=fraunces:400,500,600|source-sans-3:400,500,600&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-cm-cream text-neutral-800">
    <header class="border-b border-cm-teal/10 bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-6 py-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-cm-gold">Staff Portal</p>
                <h1 class="font-[family-name:var(--font-display)] text-lg font-medium text-cm-teal-dark">
                    Cagayan Museum
                </h1>
            </div>

            <div class="flex items-center gap-4">
                <span class="hidden text-sm text-neutral-600 sm:inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="landing-btn-primary press-scale">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-8">
        @yield('content')
    </main>
</body>

</html>
