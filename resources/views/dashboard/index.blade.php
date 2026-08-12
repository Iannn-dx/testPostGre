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
            @foreach ($stats as $stat)
                <x-stat-card
                    :value="$stat['value']"
                    :label="$stat['label']"
                    :change="$stat['change']"
                    :icon="$stat['icon']"
                />
            @endforeach
        </div>

        <x-line-chart title="Feedback Submissions" :data="$feedbackByMonth" />
    </div>
@endsection
