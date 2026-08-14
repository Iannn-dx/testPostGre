@props([
    'activeNav' => 'dashboard',
    'profile' => [
        'name' => 'Admin User',
        'role' => 'Administrator',
    ],
])

<aside class="dashboard-sidebar flex h-full w-64 shrink-0 flex-col bg-neutral-900 text-white"
    :class="{ 'dashboard-sidebar--open': sidebarOpen }">
    <div class="border-b border-white/10 px-5 py-5">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-cm-teal/20 text-cm-teal">
                <img src="{{ asset('assets/images/OIP.png') }}" alt="Cagayan Museum logo" class="h-10 w-10 rounded-4xl">
            </div>
            <div class="min-w-0">
                <p class="truncate text-sm font-semibold tracking-wide">CAGAYAN MUSEUM</p>
                <p class="truncate text-xs text-neutral-400">Visitor Feedback System</p>
            </div>
        </div>
    </div>

    <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4" aria-label="Main navigation">
        <x-sidebar-link :href="route('dashboard')" :active="$activeNav === 'dashboard'">
            <x-lucide-icon name="layout-dashboard" class="h-4 w-4 shrink-0" />
            Dashboard   
        </x-sidebar-link>

        {{-- #F7F4D8, #6B4F00, #F6D02F, #C77D00 --}}

        <x-sidebar-link :href="route('dashboard.feedback')" :active="$activeNav === 'feedback'">
            <x-lucide-icon name="message-square" class="h-4 w-4 shrink-0" />
            Feedback
        </x-sidebar-link>

        <x-sidebar-link :href="route('reports.index')" :active="$activeNav === 'reports'">
            <x-lucide-icon name="file-bar-chart" class="h-4 w-4 shrink-0" />
            Reports
        </x-sidebar-link>

        <x-sidebar-link :href="route('profile')" :active="$activeNav === 'profile'">
            <x-lucide-icon name="user" class="h-4 w-4 shrink-0" />
            Profile
        </x-sidebar-link>

        <div class="my-4 border-t border-white/10"></div>

        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-wider text-neutral-500">Administration</p>

        <x-sidebar-link :href="route('dashboard.users')" :active="$activeNav === 'users'">
            <x-lucide-icon name="users" class="h-4 w-4 shrink-0" />
            Users
        </x-sidebar-link>

    </nav>

    <div class="border-t border-white/10 px-4 py-4">
        <div class="flex items-center gap-3">
            <div
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-cm-teal text-sm font-semibold text-white">
                {{ strtoupper($profile['initials'] ?? substr($profile['name'], 0, 1)) }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium">{{ $profile['name'] }}</p>
                <p class="truncate text-xs text-neutral-400">{{ $profile['role'] }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit"
                class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm text-neutral-400 transition hover:bg-neutral-800 hover:text-white">
                <x-lucide-icon name="log-out" class="h-4 w-4" />
                Logout
            </button>
        </form>
    </div>
</aside>
