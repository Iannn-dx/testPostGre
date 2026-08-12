<?php

namespace App\Support;

use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ReportData
{
    /**
     * Build the complete report payload for the given period.
     *
     * @return array<string, mixed>
     */
    public static function build(Carbon $start, Carbon $end, string $generatedBy): array
    {
        $records = static::recordsForPeriod($start, $end);

        return [
            'periodStart' => $start,
            'periodEnd' => $end,
            'periodLabel' => ReportPeriod::formattedRange($start, $end),
            'generatedOn' => now(),
            'generatedBy' => $generatedBy,
            'logoPath' => public_path('assets/images/OIP.png'),
            'visitors' => $records,
            'feedbacks' => $records,
        ];
    }

    /**
     * @return Collection<int, Feedback>
     */
    private static function recordsForPeriod(Carbon $start, Carbon $end): Collection
    {
        $visitDate = DashboardData::effectiveVisitDateExpression();

        return Feedback::query()
            ->whereRaw("{$visitDate} BETWEEN ? AND ?", [
                $start->toDateString(),
                $end->toDateString(),
            ])
            ->orderByRaw("{$visitDate} DESC")
            ->orderByDesc('created_at')
            ->get();
    }
}
