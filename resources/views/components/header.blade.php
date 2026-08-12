@props([
    'title' => 'Dashboard',
    'subtitle' => '',
    'profile' => [
        'name' => 'Admin User',
        'role' => 'Administrator',
    ],
])

<header class="dashboard-header sticky top-0 z-20 border-b border-neutral-200 bg-white/95 backdrop-blur">
    <div class="flex items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-neutral-200 text-neutral-600 transition hover:bg-neutral-50 lg:hidden"
                @click="sidebarOpen = true" aria-label="Open navigation menu">
                <x-lucide-icon name="menu" class="h-5 w-5" />
            </button>

            <div class="min-w-0">
                <h1 class="truncate text-lg font-semibold text-neutral-900 sm:text-xl">{{ $title }}</h1>
                @if ($subtitle)
                    <p class="mt-0.5 truncate text-sm text-neutral-500">{{ $subtitle }}</p>
                @endif
            </div>
        </div>

        <div class="flex shrink-0 items-center gap-2 sm:gap-4">
            <button type="button"
                class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg border border-neutral-200 text-neutral-600 transition hover:bg-neutral-50"
                aria-label="Notifications">
                <x-lucide-icon name="bell" class="h-5 w-5" />
                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-cm-terracotta" aria-hidden="true"></span>
            </button>

            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button type="button"
                    class="flex items-center gap-2 rounded-lg border border-neutral-200 px-2 py-1.5 transition hover:bg-neutral-50 sm:gap-3 sm:px-3"
                    @click="open = !open" :aria-expanded="open" aria-haspopup="true">
                    <div
                        class="flex h-8 w-8 items-center justify-center rounded-full bg-cm-teal text-sm font-semibold text-white">
                        {{ strtoupper($profile['initials'] ?? substr($profile['name'], 0, 1)) }}
                    </div>
                    <div class="hidden text-left sm:block">
                        <p class="text-sm font-medium text-neutral-900">{{ $profile['name'] }}</p>
                        <p class="text-xs text-neutral-500">{{ $profile['role'] }}</p>
                    </div>
                    <x-lucide-icon name="chevron-down" class="hidden h-4 w-4 text-neutral-400 sm:block"
                        ::class="{ 'rotate-180': open }" />
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-52 origin-top-right rounded-lg border border-neutral-200 bg-white py-1 shadow-lg"
                    role="menu" x-cloak>
                    <a href="{{ route('profile') }}"
                        class="block px-4 py-2 text-sm text-neutral-700 hover:bg-neutral-50" role="menuitem">
                        My Profile
                    </a>
                    <div class="my-1 border-t border-neutral-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full px-4 py-2 text-left text-sm text-neutral-700 hover:bg-neutral-50"
                            role="menuitem">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
