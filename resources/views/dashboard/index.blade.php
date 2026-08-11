@extends('layouts.admin')

@section('title', 'Dashboard — Cagayan Museum')

@section('content')
    <div class="rounded-2xl border border-cm-teal/10 bg-white/80 p-8 shadow-sm">
        <h2 class="font-[family-name:var(--font-display)] text-2xl font-medium text-cm-teal-dark">
            Welcome, {{ auth()->user()->name }}
        </h2>
        <p class="mt-2 max-w-2xl text-neutral-600">
            You are signed in to the Cagayan Museum Visitor Feedback System. Staff tools for reviewing
            submissions will be available here.
        </p>
    </div>
@endsection
