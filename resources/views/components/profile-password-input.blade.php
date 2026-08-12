@props([
    'id' => null,
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'autocomplete' => null,
])

@php
    $inputId = $id ?? $name;
@endphp

<div {{ $attributes->merge(['class' => 'profile-field']) }} x-data="{ show: false }">
    @if ($label)
        <label for="{{ $inputId }}" class="profile-label">{{ $label }}</label>
    @endif

    <div class="profile-password">
        <input id="{{ $inputId }}" type="password" name="{{ $name }}" value="{{ $value }}"
            @if ($required) required @endif
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            class="profile-input profile-input--password @error($name) profile-input--error @enderror"
            placeholder="{{ $placeholder }}" :type="show ? 'text' : 'password'">

        <button type="button" class="profile-password__toggle" @click="show = !show"
            :aria-label="show ? 'Hide password' : 'Show password'" :aria-pressed="show.toString()"
            tabindex="-1">
            <x-lucide-icon name="eye" class="h-4 w-4" x-show="!show" />
            <x-lucide-icon name="eye-off" class="h-4 w-4" x-show="show" x-cloak />
        </button>
    </div>

    @error($name)
        <p class="profile-error">{{ $message }}</p>
    @enderror
</div>
