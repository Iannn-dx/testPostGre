@extends('layouts.dashboard', [
    'activeNav' => 'dashboard',
    'headerTitle' => 'Dashboard',
    'headerSubtitle' => 'Overview of museum visitor feedback and activity.',
    'profile' => $profile,
])

@section('title', 'Dashboard — Cagayan Museum')

@section('content')
    <x-line-chart
        title="User Feedback"
        :data="$feedbackByMonth"
    />
@endsection
