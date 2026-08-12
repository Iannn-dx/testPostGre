<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Visitor Feedback — Cagayan Museum')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=fraunces:400,500,600|source-sans-3:400,500,600&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/feedback-form.js'])
</head>

<body class="feedback-page font-sans antialiased">
    <div class="feedback-shell flex min-h-screen flex-col">
        <div class="feedback-ambient" aria-hidden="true">
            <div class="feedback-ambient__orb feedback-ambient__orb--teal"></div>
            <div class="feedback-ambient__orb feedback-ambient__orb--sand"></div>
        </div>

        <header class="feedback-header">
            <div class="feedback-header__inner mx-auto flex items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="feedback-header__brand">
                    <div class="feedback-logo">
                        <img src="{{ asset('assets/images/OIP.png') }}" alt="Cagayan Museum logo"
                            class="feedback-logo__image">
                    </div>
                    <div>
                        <p class="feedback-header__eyebrow">National Museum of the Philippines</p>
                        <p class="feedback-header__title">Cagayan Museum &amp; Historical Research Center</p>
                        <p class="feedback-header__location">Tuguegarao City, Cagayan</p>
                    </div>
                </a>

                @auth
                    <a href="{{ route('dashboard') }}" class="landing-btn-primary shrink-0">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="landing-btn-staff shrink-0">
                        Login
                    </a>
                @endauth
            </div>
        </header>

        <main class="feedback-main-wrap">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>
