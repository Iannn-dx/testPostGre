@extends('layouts.landing')

@section('title', 'Share Your Experience — Cagayan Museum')

@php
    $ageLabels = [
        '1-12' => '1–12',
        '13-17' => '13–17',
        '18-49' => '18–49',
        '50+' => '50+',
    ];

    $genderLabels = [
        'male' => 'Male',
        'female' => 'Female',
        'prefer_not_to_say' => 'Prefer not to say',
        'other' => 'Other',
    ];

    $residenceLabels = [
        'tuguegarao_city' => 'Tuguegarao City',
        'cagayan' => 'Cagayan Province',
        'philippines' => 'Other PH areas',
        'international' => 'International',
    ];

    $experienceLabels = [
        'excellent' => 'Excellent',
        'good' => 'Good',
        'average' => 'Average',
        'poor' => 'Poor',
        'bad' => 'Bad',
    ];
@endphp

@section('content')
    <div class="feedback-kiosk">
        <div class="feedback-kiosk__intro">
            <h2 class="feedback-kiosk__heading">Share Your Museum Experience</h2>
            <p class="feedback-kiosk__lede">Your feedback helps us preserve heritage and improve every visit.</p>
        </div>

        @if (session('status'))
            <div class="feedback-alert feedback-alert--success feedback-alert--compact" role="status">
                <svg class="feedback-alert__icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                        clip-rule="evenodd" />
                </svg>
                <p>{{ session('status') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="feedback-alert feedback-alert--error feedback-alert--compact" role="alert">
                <svg class="feedback-alert__icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.59a.75.75 0 01-1.5 0V5.75A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                        clip-rule="evenodd" />
                </svg>
                <p>{{ $errors->first() }}</p>
            </div>
        @endif

        <form id="visitor-feedback-form" class="feedback-kiosk__form" method="POST"
            action="{{ route('feedback.store') }}" novalidate>
            @csrf

            <div class="feedback-kiosk__body">
                <section class="feedback-panel" aria-labelledby="section-about">
                    <h3 id="section-about" class="feedback-panel__title">About You</h3>

                    <div class="feedback-panel__content">
                        <div class="feedback-row feedback-row--2">
                            <div class="feedback-field">
                                <label for="name" class="feedback-label">
                                    Name <span class="feedback-label__optional">optional</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="feedback-input" placeholder="Your name" autocomplete="name" maxlength="255">
                            </div>
                            <div class="feedback-field">
                                <label for="visit_date" class="feedback-label">
                                    Visit Date <span class="feedback-label__optional">optional</span>
                                </label>
                                <input type="date" id="visit_date" name="visit_date" value="{{ old('visit_date') }}"
                                    class="feedback-input" max="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <fieldset class="feedback-fieldset">
                            <legend class="feedback-label">Age Range</legend>
                            <div class="feedback-chips feedback-chips--4" role="radiogroup" aria-label="Age range">
                                @foreach ($ageRanges as $range)
                                    <label class="feedback-chip">
                                        <input type="radio" name="age_range" value="{{ $range }}"
                                            @checked(old('age_range') === $range)>
                                        <span>{{ $ageLabels[$range] ?? $range }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </fieldset>

                        <fieldset class="feedback-fieldset">
                            <legend class="feedback-label">Gender</legend>
                            <div class="feedback-chips feedback-chips--4" role="radiogroup" aria-label="Gender">
                                @foreach ($genders as $gender)
                                    <label class="feedback-chip">
                                        <input type="radio" name="gender" value="{{ $gender }}"
                                            @checked(old('gender') === $gender)>
                                        <span>{{ $genderLabels[$gender] ?? $gender }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="feedback-field feedback-field--inline">
                                <input type="text" id="gender_other" name="gender_other"
                                    value="{{ old('gender_other') }}" class="feedback-input"
                                    placeholder="If other, please specify" maxlength="255"
                                    aria-label="Gender specification"
                                    @if (old('gender') === 'other') required @endif>
                            </div>
                        </fieldset>

                        <fieldset class="feedback-fieldset">
                            <legend class="feedback-label">Place of Residence</legend>
                            <div class="feedback-residence-grid" role="radiogroup" aria-label="Place of residence">
                                @foreach ($residenceTypes as $type)
                                    <label class="feedback-residence-card">
                                        <input type="radio" name="residence_type" value="{{ $type }}"
                                            @checked(old('residence_type') === $type)>
                                        <span class="feedback-residence-card__label">
                                            {{ $residenceLabels[$type] ?? $type }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            <div class="feedback-field feedback-field--inline">
                                <input type="text" id="residence_detail" name="residence_detail"
                                    value="{{ old('residence_detail') }}" class="feedback-input"
                                    placeholder="City / municipality / country (optional)" maxlength="255"
                                    aria-label="Residence details">
                            </div>
                        </fieldset>
                    </div>
                </section>

                <div class="feedback-kiosk__right">
                    <section class="feedback-panel" aria-labelledby="section-experience">
                        <h3 id="section-experience" class="feedback-panel__title">Rate Your Experience</h3>

                        <fieldset class="feedback-fieldset">
                            <legend class="sr-only">Overall experience rating</legend>
                            <div class="feedback-rating-grid" role="radiogroup" aria-label="Overall experience">
                                @foreach ($overallExperiences as $experience)
                                    <label
                                        class="feedback-rating-card feedback-rating-card--{{ $experience }}">
                                        <input type="radio" name="overall_experience" value="{{ $experience }}"
                                            @checked(old('overall_experience') === $experience)>
                                        <span class="feedback-rating-card__face" aria-hidden="true">
                                            @if ($experience === 'excellent')
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path d="M8.5 10.5h.01M15.5 10.5h.01" stroke-linecap="round" />
                                                    <path d="M8.5 15c1.2 1.5 2.5 2.25 3.5 2.25S14.3 16.5 15.5 15"
                                                        stroke-linecap="round" />
                                                </svg>
                                            @elseif ($experience === 'good')
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path d="M8.5 10.5h.01M15.5 10.5h.01" stroke-linecap="round" />
                                                    <path d="M9 14.5c1 1 2 1.5 3 1.5s2-.5 3-1.5" stroke-linecap="round" />
                                                </svg>
                                            @elseif ($experience === 'average')
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path d="M8.5 10.5h.01M15.5 10.5h.01" stroke-linecap="round" />
                                                    <path d="M9 14.5h6" stroke-linecap="round" />
                                                </svg>
                                            @elseif ($experience === 'poor')
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path d="M8.5 10.5h.01M15.5 10.5h.01" stroke-linecap="round" />
                                                    <path d="M9 14.5c1-1 2-1.5 3-1.5s2 .5 3 1.5" stroke-linecap="round" />
                                                </svg>
                                            @else
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.5">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path d="M8.5 10.5h.01M15.5 10.5h.01" stroke-linecap="round" />
                                                    <path d="M9 15c1.2-1.5 2.5-2.25 3.5-2.25S14.3 13.5 15.5 15"
                                                        stroke-linecap="round" />
                                                </svg>
                                            @endif
                                        </span>
                                        <span class="feedback-rating-card__label">
                                            {{ $experienceLabels[$experience] ?? $experience }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </fieldset>
                    </section>

                    <section class="feedback-panel feedback-panel--grow" aria-labelledby="section-comments">
                        <h3 id="section-comments" class="feedback-panel__title">Comments &amp; Suggestions</h3>
                        <div class="feedback-field feedback-field--grow">
                            <label for="comments" class="sr-only">Comments and suggestions</label>
                            <textarea id="comments" name="comments" class="feedback-textarea"
                                placeholder="Share your thoughts about exhibits, staff, facilities, or accessibility…"
                                maxlength="5000">{{ old('comments') }}</textarea>
                        </div>
                    </section>
                </div>
            </div>

            <div class="feedback-kiosk__bar">
                <div class="feedback-privacy">
                    <label class="feedback-checkbox">
                        <input type="checkbox" name="privacy_agreement" value="1" required
                            @checked(old('privacy_agreement'))>
                        <span class="feedback-checkbox__box" aria-hidden="true"></span>
                        <span class="feedback-privacy__text">
                            I agree to the Data Privacy Notice (RA 10173). Information is used only to improve museum
                            services and will not be sold or shared except as required by law.
                        </span>
                    </label>
                </div>

                <button type="submit" class="feedback-submit press-scale">
                    Submit Feedback
                </button>
            </div>
        </form>
    </div>
@endsection
