@extends('layouts.dashboard', [
    'activeNav' => 'users',
    'headerTitle' => 'Users',
    'headerSubtitle' => 'Manage staff and administrator accounts.',
    'profile' => $profile,
])

@section('title', 'Users — Cagayan Museum')

@section('content')
    <div class="space-y-6">
        <section class="feedback-panel" aria-labelledby="users-filters-heading">
            <div class="feedback-panel__header">
                <div>
                    <h2 id="users-filters-heading" class="feedback-panel__title">Search</h2>
                    <p class="feedback-panel__subtitle">Find users by name, email, or phone number.</p>
                </div>
            </div>

            <form method="GET" action="{{ route('dashboard.users') }}" class="feedback-filters feedback-filters--extended">
                <div class="feedback-filters__field feedback-filters__field--grow">
                    <label for="search" class="feedback-label">Search</label>
                    <div class="feedback-search">
                        <x-lucide-icon name="search" class="feedback-search__icon h-4 w-4" />
                        <input id="search" type="search" name="search" value="{{ $filters['search'] }}"
                            placeholder="Name, email, or phone number" class="feedback-input feedback-search__input">
                    </div>
                </div>

                <div class="feedback-filters__field">
                    <label for="role" class="feedback-label">Role</label>
                    <select id="role" name="role" class="feedback-select">
                        <option value="">All roles</option>
                        @foreach (\App\Models\User::roles() as $role)
                            <option value="{{ $role }}" @selected($filters['role'] === $role)>
                                {{ \App\Models\User::roleLabels()[$role] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="feedback-filters__field">
                    <label for="status" class="feedback-label">Status</label>
                    <select id="status" name="status" class="feedback-select">
                        <option value="">All statuses</option>
                        @foreach (\App\Models\User::statuses() as $status)
                            <option value="{{ $status }}" @selected($filters['status'] === $status)>
                                {{ \App\Models\User::statusLabels()[$status] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="feedback-filters__actions">
                    <button type="submit" class="feedback-btn feedback-btn--primary">
                        Apply
                    </button>
                    @if ($filters['search'] !== '' || $filters['role'] !== '' || $filters['status'] !== '')
                        <a href="{{ route('dashboard.users') }}" class="feedback-btn feedback-btn--ghost">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </section>

        <section class="feedback-panel" aria-labelledby="users-list-heading">
            <div class="feedback-panel__header feedback-panel__header--row">
                <div>
                    <h2 id="users-list-heading" class="feedback-panel__title">Accounts</h2>
                    {{-- <p class="feedback-panel__subtitle">
                        @if ($users->total() === 0)
                            No users found.
                        @elseif ($users->total() === 1)
                            1 account
                        @else
                            {{ number_format($users->total()) }} accounts
                        @endif
                    </p> --}}
                </div>

                @if ($users->total() > 0)
                    <p class="feedback-panel__meta">
                        Showing {{ $users->firstItem() }}–{{ $users->lastItem() }}
                    </p>
                @endif
            </div>

            @if ($users->isEmpty())
                <div class="feedback-empty">
                    <div class="feedback-empty__icon" aria-hidden="true">
                        <x-lucide-icon name="users" class="h-6 w-6" />
                    </div>
                    <h3 class="feedback-empty__title">No users found</h3>
                    <p class="feedback-empty__text">
                        @if ($filters['search'] !== '' || $filters['role'] !== '' || $filters['status'] !== '')
                            Try adjusting your search or filters to find matching accounts.
                        @else
                            Staff accounts will appear here once users are registered.
                        @endif
                    </p>
                </div>
            @else
                <div class="feedback-table-wrap" x-data="{ openId: null }">
                    <table class="feedback-table">
                        <thead>
                            <tr>
                                <th scope="col">User</th>
                                <th scope="col">Role</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="hidden lg:table-cell">Phone</th>
                                <th scope="col" class="hidden md:table-cell">Last Login</th>
                                <th scope="col">Joined</th>
                                <th scope="col"><span class="sr-only">Details</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr :class="{ 'feedback-table__row--open': openId === {{ $user->id }} }">
                                    <td>
                                        <div class="feedback-table__visitor">
                                            <span class="feedback-table__name">{{ $user->fullName() }}</span>
                                            <span class="feedback-table__meta hidden sm:inline">
                                                {{ $user->email }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <x-user-role-badge :role="$user->role" />
                                    </td>
                                    <td>
                                        <x-user-status-badge :status="$user->status" />
                                    </td>
                                    <td class="hidden lg:table-cell">
                                        @if (filled($user->phone))
                                            {{ $user->phone }}
                                        @else
                                            <span class="text-neutral-400">—</span>
                                        @endif
                                    </td>
                                    <td class="hidden md:table-cell feedback-table__date">
                                        {{ $user->last_login_at?->format('M j, Y') ?? '—' }}
                                    </td>
                                    <td class="feedback-table__date">
                                        {{ $user->created_at?->format('M j, Y') ?? '—' }}
                                    </td>
                                    <td class="feedback-table__actions">
                                        <button type="button" class="feedback-table__toggle"
                                            @click="openId = openId === {{ $user->id }} ? null : {{ $user->id }}"
                                            :aria-expanded="openId === {{ $user->id }}">
                                            <span class="sr-only">View details</span>
                                            <x-lucide-icon name="chevron-down" class="h-4 w-4" ::class="{ 'rotate-180': openId === {{ $user->id }} }" />
                                        </button>
                                    </td>
                                </tr>
                                <tr x-show="openId === {{ $user->id }}" x-cloak class="feedback-table__detail-row">
                                    <td colspan="7">
                                        <div class="feedback-detail">
                                            <dl class="feedback-detail__grid">
                                                <div class="feedback-detail__item">
                                                    <dt>Full Name</dt>
                                                    <dd>{{ $user->fullName() }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Email</dt>
                                                    <dd>{{ $user->email }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Phone</dt>
                                                    <dd>{{ $user->phone ?? 'Not provided' }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Role</dt>
                                                    <dd>
                                                        <x-user-role-badge :role="$user->role" />
                                                    </dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Status</dt>
                                                    <dd>
                                                        <x-user-status-badge :status="$user->status" />
                                                    </dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Last Login</dt>
                                                    <dd>{{ $user->last_login_at?->format('F j, Y g:i A') ?? 'Never logged in' }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Password Changed</dt>
                                                    <dd>{{ $user->passwordLastChangedLabel() }}</dd>
                                                </div>
                                                <div class="feedback-detail__item">
                                                    <dt>Joined</dt>
                                                    <dd>{{ $user->created_at?->format('F j, Y g:i A') ?? '—' }}</dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="feedback-pagination">
                        {{ $users->links() }}
                    </div>
                @endif
            @endif
        </section>
    </div>
@endsection
