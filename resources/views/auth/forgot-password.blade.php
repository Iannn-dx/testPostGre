@extends('layouts.auth-split')

@section('title', 'Forgot Password — Cagayan Museum')

@section('content')
    <x-auth-split-header title="Reset Password"
        description="Enter your staff email and we'll send you a reset link." />

    @if (session('status'))
        <div class="auth-alert auth-alert--success" role="status">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <label for="email" class="auth-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" class="auth-input @error('email') auth-input--error @enderror"
                placeholder="you@museum.gov.ph">
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-submit press-scale">
            Email Reset Link
        </button>

        <p class="auth-footer-link">
            <a href="{{ route('login') }}">Back to login</a>
        </p>
    </form>
@endsection
