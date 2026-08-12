@extends('layouts.dashboard', [
    'activeNav' => 'dashboard',
    'headerTitle' => 'Dashboard',
    'headerSubtitle' => 'Overview of museum visitor feedback and activity.',
    'profile' => $profile,
])

@section('title', 'Dashboard — Cagayan Museum')

@section('content')
    <div class="space-y-6">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($summaryStats as $stat)
                <x-stat-card
                    :value="$stat['value']"
                    :label="$stat['label']"
                    :change="$stat['change']"
                    :icon="$stat['icon']"
                />
            @endforeach
        </div>

        <x-line-chart
            title="Visitor Visits"
            chart-id="visitor-visits-chart"
            :data="$visitorsByMonth"
            dataset-label="Visitor visits"
            tooltip-suffix=" visits"
        />

        <div class="grid gap-4 lg:grid-cols-2">
            <x-line-chart
                title="Feedback Submissions"
                chart-id="feedback-submissions-chart"
                :data="$feedbackByMonth"
                dataset-label="Feedback submissions"
                tooltip-suffix=" submissions"
            />

            <x-line-chart
                title="Rating Distribution"
                chart-id="rating-distribution-chart"
                type="bar"
                :data="$ratingDistribution"
                dataset-label="Rating count"
                tooltip-suffix=" responses"
            />
        </div>

        <section class="dashboard-chart-card rounded-xl border border-neutral-200 bg-white p-5 shadow-sm">
            <h3 class="mb-4 text-base font-semibold text-neutral-900">Recent Feedback</h3>

            @if ($recentFeedback->isEmpty())
                <p class="text-sm text-neutral-500">
                    No feedback submissions yet. Visitor responses will appear here once the public feedback form is used.
                </p>
            @else
                <div class="space-y-3">
                    @foreach ($recentFeedback as $feedback)
                        <x-feedback-card
                            :rating="$feedback->experienceScore() ?? 0"
                            :comment="$feedback->comments ?: 'No comment provided.'"
                            :author="filled($feedback->name) ? $feedback->name : 'Anonymous Visitor'"
                            :date="$feedback->created_at->format('M j, Y')"
                        />
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
