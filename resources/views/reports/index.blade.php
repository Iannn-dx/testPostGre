@extends('layouts.dashboard', [
    'activeNav' => 'reports',
    'headerTitle' => 'Reports',
    'headerSubtitle' => 'Generate official visitor feedback reports for the selected period.',
    'profile' => $profile,
])

@section('title', 'Reports — Cagayan Museum')

@section('content')
    <div class="reports-page">
        {{-- Report filter --}}
        <section class="report-controls" aria-labelledby="report-controls-heading">
            <h2 id="report-controls-heading" class="report-controls__title">Report Period</h2>

            @if ($errors->any())
                <p class="report-controls__error" role="alert">{{ $errors->first() }}</p>
            @endif

            <form method="GET" action="{{ route('reports.index') }}" class="report-filters">
                <input type="hidden" name="generated" value="1">

                <div class="report-filters__field">
                    <label for="start_date" class="report-label">Start Date</label>
                    <input id="start_date" type="date" name="start_date" value="{{ $filters['start_date'] }}"
                        class="report-input" required>
                </div>

                <div class="report-filters__field">
                    <label for="end_date" class="report-label">End Date</label>
                    <input id="end_date" type="date" name="end_date" value="{{ $filters['end_date'] }}"
                        class="report-input" required>
                </div>

                <div class="report-filters__actions">
                    <button type="submit" class="report-btn report-btn--primary">
                        Generate Report
                    </button>
                </div>
            </form>
        </section>

        @if ($generated && $report)
            <div class="report-preview">
                <div class="report-preview__toolbar">
                    <p class="report-preview__label">Report Preview</p>

                    <a href="{{ route('reports.pdf', ['start_date' => $filters['start_date'], 'end_date' => $filters['end_date']]) }}"
                        class="report-btn report-btn--secondary">
                        Download PDF
                    </a>
                </div>

                <div class="report-preview__document">
                    @include('reports.partials.document', ['documentClass' => 'report-document--screen'])
                </div>
            </div>
        @endif
    </div>
@endsection
