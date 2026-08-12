@extends('layouts.dashboard', [
    'activeNav' => 'profile',
    'headerTitle' => 'Profile',
    'headerSubtitle' => 'Manage your personal information and account settings.',
    'profile' => $profile,
])

@section('title', 'Profile — Cagayan Museum')

@section('content')
    <div class="space-y-6">
        @if (session('profile_status'))
            <x-dashboard-alert type="success" :message="session('profile_status')" />
        @endif

        @if (session('password_status'))
            <x-dashboard-alert type="success" :message="session('password_status')" />
        @endif

        @if ($errors->any() && ! session('profile_status') && ! session('password_status'))
            <x-dashboard-alert type="error" message="Please correct the errors below." />
        @endif

        {{-- Row 1: Profile card + Personal information --}}
        <div class="grid gap-6 lg:grid-cols-12">
            <aside class="lg:col-span-4">
                <div class="profile-card">
                    <div class="profile-card__avatar" aria-hidden="true">
                        {{ $user->initials() }}
                    </div>
                    <h2 class="profile-card__name">{{ $user->fullName() }}</h2>
                    <p class="profile-card__role">{{ $user->roleLabel() }}</p>

                    @if ($user->isActive())
                        <span class="profile-status profile-status--active">
                            <span class="profile-status__dot" aria-hidden="true"></span>
                            Active
                        </span>
                    @else
                        <span class="profile-status profile-status--inactive">
                            <span class="profile-status__dot" aria-hidden="true"></span>
                            {{ $user->statusLabel() }}
                        </span>
                    @endif

                    <p class="profile-card__email">{{ $user->email }}</p>

                    <form method="POST" action="{{ route('logout') }}" class="profile-card__logout">
                        @csrf
                        <button type="submit" class="profile-btn profile-btn--ghost">
                            <x-lucide-icon name="log-out" class="h-4 w-4" />
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            <section class="profile-panel lg:col-span-8" aria-labelledby="personal-info-heading">
                <div class="profile-panel__header">
                    <div>
                        <h3 id="personal-info-heading" class="profile-panel__title">Personal Information</h3>
                        <p class="profile-panel__subtitle">Update your personal details.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" class="profile-form">
                    @csrf
                    @method('PATCH')

                    <div class="profile-form__grid profile-form__grid--2">
                        <div class="profile-field">
                            <label for="first_name" class="profile-label">First Name</label>
                            <input id="first_name" type="text" name="first_name"
                                value="{{ old('first_name', $user->first_name) }}" required autocomplete="given-name"
                                class="profile-input @error('first_name') profile-input--error @enderror">
                            @error('first_name')
                                <p class="profile-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="profile-field">
                            <label for="last_name" class="profile-label">Last Name</label>
                            <input id="last_name" type="text" name="last_name"
                                value="{{ old('last_name', $user->last_name) }}" required autocomplete="family-name"
                                class="profile-input @error('last_name') profile-input--error @enderror">
                            @error('last_name')
                                <p class="profile-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="profile-form__grid profile-form__grid--2">
                        <div class="profile-field">
                            <label for="email" class="profile-label">Email Address</label>
                            <input id="email" type="email" name="email"
                                value="{{ old('email', $user->email) }}" required autocomplete="email"
                                class="profile-input @error('email') profile-input--error @enderror">
                            @error('email')
                                <p class="profile-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="profile-field">
                            <label for="phone" class="profile-label">
                                Phone Number
                                <span class="profile-label__optional">optional</span>
                            </label>
                            <input id="phone" type="tel" name="phone"
                                value="{{ old('phone', $user->phone) }}" autocomplete="tel"
                                placeholder="09XXXXXXXXX"
                                class="profile-input @error('phone') profile-input--error @enderror">
                            @error('phone')
                                <p class="profile-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="profile-form__actions">
                        <button type="submit" class="profile-btn profile-btn--primary">
                            Save Changes
                        </button>
                    </div>
                </form>
            </section>
        </div>

        {{-- Row 2: Change password + Account / Security --}}
        <div class="grid gap-6 lg:grid-cols-2">
            <section class="profile-panel" aria-labelledby="password-heading">
                <div class="profile-panel__header">
                    <div>
                        <h3 id="password-heading" class="profile-panel__title">Change Password</h3>
                        <p class="profile-panel__subtitle">Update your password to keep your account secure.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.password.update') }}" class="profile-form">
                    @csrf
                    @method('PATCH')

                    <x-profile-password-input name="current_password" label="Current Password"
                        placeholder="Enter current password" required autocomplete="current-password" />

                    <x-profile-password-input name="password" label="New Password"
                        placeholder="Enter new password" required autocomplete="new-password" />

                    <x-profile-password-input name="password_confirmation" label="Confirm New Password"
                        placeholder="Confirm new password" required autocomplete="new-password" />

                    <div class="profile-form__actions">
                        <button type="submit" class="profile-btn profile-btn--primary">
                            Update Password
                        </button>
                    </div>
                </form>
            </section>

            <div class="space-y-6">
                <section class="profile-panel" aria-labelledby="account-info-heading">
                    <div class="profile-panel__header">
                        <h3 id="account-info-heading" class="profile-panel__title">Account Information</h3>
                    </div>

                    <dl class="profile-meta">
                        <div class="profile-meta__row">
                            <dt>Role</dt>
                            <dd>{{ $user->roleLabel() }}</dd>
                        </div>
                        <div class="profile-meta__row">
                            <dt>Account Status</dt>
                            <dd>{{ $user->statusLabel() }}</dd>
                        </div>
                        <div class="profile-meta__row">
                            <dt>Member Since</dt>
                            <dd>{{ $user->created_at?->format('F j, Y') ?? '—' }}</dd>
                        </div>
                        <div class="profile-meta__row">
                            <dt>Last Login</dt>
                            <dd>{{ $user->last_login_at?->format('F j, Y') ?? '—' }}</dd>
                        </div>
                    </dl>
                </section>

                <section class="profile-panel" aria-labelledby="security-heading">
                    <div class="profile-panel__header">
                        <h3 id="security-heading" class="profile-panel__title">Security</h3>
                    </div>

                    <dl class="profile-meta">
                        <div class="profile-meta__row">
                            <dt class="profile-meta__label-with-icon">
                                <x-lucide-icon name="lock" class="h-4 w-4 text-neutral-400" />
                                Password
                            </dt>
                            <dd>{{ $user->passwordLastChangedLabel() }}</dd>
                        </div>
                        <div class="profile-meta__row">
                            <dt class="profile-meta__label-with-icon">
                                <x-lucide-icon name="shield" class="h-4 w-4 text-neutral-400" />
                                Two-Factor Authentication
                            </dt>
                            <dd>
                                <span class="profile-badge profile-badge--muted">Coming Soon</span>
                            </dd>
                        </div>
                        <div class="profile-meta__row">
                            <dt class="profile-meta__label-with-icon">
                                <x-lucide-icon name="users" class="h-4 w-4 text-neutral-400" />
                                Active Sessions
                            </dt>
                            <dd>
                                <span class="profile-badge profile-badge--muted">Coming Soon</span>
                            </dd>
                        </div>
                    </dl>
                </section>
            </div>
        </div>
    </div>
@endsection
