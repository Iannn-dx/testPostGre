<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Staff Login — Cagayan Museum')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=fraunces:400,500,600|source-sans-3:400,500,600&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/auth-login.js'])
</head>

<body class="auth-page font-sans antialiased">
    <div class="auth-split">
        <div class="auth-split__form">
            <div class="auth-split__form-inner">
                @yield('content')
            </div>
        </div>

        <aside class="auth-split__visual" aria-hidden="true">
            <div class="auth-split__visual-bg"></div>
            <div class="auth-split__visual-content">
                <div class="auth-split__visual-logo">
                    <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="18" width="40" height="24" rx="1" stroke="currentColor"
                            stroke-width="1.5" />
                        <path d="M4 24h40" stroke="currentColor" stroke-width="1.5" />
                        <path d="M14 18V10h6v8M28 18V10h6v8" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path d="M10 42v-4M38 42v-4" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" />
                        <circle cx="24" cy="31" r="4" stroke="currentColor" stroke-width="1.5" />
                    </svg>
                </div>
                <p class="auth-split__visual-eyebrow">National Museum of the Philippines</p>
                <h2 class="auth-split__visual-title">Cagayan Museum &amp; Historical Research Center</h2>
                <p class="auth-split__visual-location">Tuguegarao City, Cagayan</p>
                <p class="auth-split__visual-tagline">Preserving heritage. Inspiring discovery.</p>
            </div>
        </aside>
    </div>
</body>

</html>
