<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard — Cagayan Museum')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=source-sans-3:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-neutral-100 text-neutral-800" x-data="{ sidebarOpen: false }"
    @keydown.escape.window="sidebarOpen = false">

    <div class="flex h-screen overflow-hidden">
        {{-- Mobile overlay --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-neutral-900/50 lg:hidden"
            @click="sidebarOpen = false" x-cloak aria-hidden="true"></div>

        {{-- Sidebar --}}
        <div class="fixed inset-y-0 left-0 z-50 -translate-x-full transition-transform duration-200 lg:static lg:translate-x-0 lg:transition-none"
            :class="{ 'translate-x-0': sidebarOpen }">
            <div class="relative h-full">
                <button type="button"
                    class="absolute right-3 top-3 inline-flex h-8 w-8 items-center justify-center rounded-md text-neutral-400 hover:bg-neutral-800 hover:text-white lg:hidden"
                    @click="sidebarOpen = false" aria-label="Close navigation menu">
                    <x-lucide-icon name="x" class="h-5 w-5" />
                </button>

                <x-sidebar :active-nav="$activeNav ?? 'dashboard'"
                    :profile="$profile ?? (auth()->check() ? auth()->user()->toProfileArray() : \App\Support\DashboardSampleData::profile())" />
            </div>
        </div>

        {{-- Main content --}}
        <div class="flex min-w-0 flex-1 flex-col overflow-hidden">
            <x-header :title="$headerTitle ?? 'Dashboard'" :subtitle="$headerSubtitle ?? ''"
                :profile="$profile ?? (auth()->check() ? auth()->user()->toProfileArray() : \App\Support\DashboardSampleData::profile())" />

            <main class="flex-1 overflow-y-auto">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
