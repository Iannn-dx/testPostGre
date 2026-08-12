<?php

namespace App\Support;

use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DashboardData
{
    /**
     * PostgreSQL expression for the effective visit date of a feedback record.
     */
    public static function effectiveVisitDateExpression(): string
    {
        return 'COALESCE(visit_date, created_at::date)';
    }

    /**
     * Top-level summary stats for the dashboard.
     *
     * @return list<array{value: string, label: string, change: string|null, icon: string}>
     */
    public static function summaryStats(): array
    {
        $now = now();
        $visitDate = static::effectiveVisitDateExpression();
        $total = Feedback::count();
        $thisMonth = static::visitorQuery()
            ->whereRaw("EXTRACT(YEAR FROM {$visitDate}) = ?", [$now->year])
            ->whereRaw("EXTRACT(MONTH FROM {$visitDate}) = ?", [$now->month])
            ->count();
        $averageRating = Feedback::averageExperienceScore();
        $satisfactionRate = static::satisfactionRate();

        return [
            [
                'value' => number_format($total),
                'label' => 'Total Visitors',
                'change' => number_format($thisMonth).' this month',
                'icon' => 'users',
            ],
            [
                'value' => $averageRating !== null ? number_format($averageRating, 1).' / 5' : '— / 5',
                'label' => 'Average Rating',
                'change' => null,
                'icon' => 'star',
            ],
            [
                'value' => $total > 0 ? number_format($satisfactionRate).'%' : '0%',
                'label' => 'Satisfaction Rate',
                'change' => 'Ratings 4–5 stars',
                'icon' => 'smile',
            ],
        ];
    }

    /**
     * Monthly visitor counts for the current year (January through December).
     *
     * @return list<array{label: string, value: int}>
     */
    public static function visitorsByMonth(): array
    {
        $year = now()->year;
        $visitDate = static::effectiveVisitDateExpression();

        $counts = static::visitorQuery()
            ->selectRaw("EXTRACT(MONTH FROM {$visitDate})::integer as month")
            ->selectRaw('COUNT(*) as total')
            ->whereRaw("EXTRACT(YEAR FROM {$visitDate}) = ?", [$year])
            ->groupBy('month')
            ->pluck('total', 'month');

        return static::monthlyChartData($counts);
    }

    /**
     * Monthly feedback submission counts for the current year (January through December).
     *
     * @return list<array{label: string, value: int}>
     */
    public static function feedbackByMonth(): array
    {
        $year = now()->year;

        $counts = Feedback::query()
            ->selectRaw('EXTRACT(MONTH FROM created_at)::integer as month')
            ->selectRaw('COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        return static::monthlyChartData($counts);
    }

    /**
     * Feedback rating distribution on a 1–5 star scale.
     *
     * @return list<array{label: string, value: int}>
     */
    public static function ratingDistribution(): array
    {
        $experienceCounts = Feedback::query()
            ->selectRaw('overall_experience, COUNT(*) as total')
            ->whereNotNull('overall_experience')
            ->groupBy('overall_experience')
            ->pluck('total', 'overall_experience');

        $scores = Feedback::experienceScores();

        return Collection::range(5, 1)
            ->map(function (int $stars) use ($experienceCounts, $scores): array {
                $count = $experienceCounts
                    ->filter(fn (int $total, string $experience): bool => ($scores[$experience] ?? null) === $stars)
                    ->sum();

                return [
                    'label' => "{$stars} star".($stars === 1 ? '' : 's'),
                    'value' => (int) $count,
                ];
            })
            ->values()
            ->all();
    }

    /**
     * Latest feedback submissions for the dashboard list.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Feedback>
     */
    public static function recentFeedback(int $limit = 5): \Illuminate\Database\Eloquent\Collection
    {
        return Feedback::query()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * @return array<string, string>
     */
    public static function profile(): array
    {
        return [
            'name' => 'Admin User',
            'role' => 'Administrator',
            'email' => 'admin@museum.local',
            'status' => 'Active',
            'last_login' => now()->subDay()->format('F j, Y'),
        ];
    }

    private static function visitorQuery(): Builder
    {
        return Feedback::query();
    }

    private static function satisfactionRate(): int
    {
        $total = Feedback::query()->whereNotNull('overall_experience')->count();

        if ($total === 0) {
            return 0;
        }

        $satisfied = Feedback::query()
            ->whereIn('overall_experience', [
                Feedback::EXPERIENCE_EXCELLENT,
                Feedback::EXPERIENCE_GOOD,
            ])
            ->count();

        return (int) round(($satisfied / $total) * 100);
    }

    /**
     * @param  \Illuminate\Support\Collection<int|string, mixed>  $counts
     * @return list<array{label: string, value: int}>
     */
    private static function monthlyChartData(Collection $counts): array
    {
        $year = now()->year;

        return Collection::range(1, 12)
            ->map(function (int $month) use ($year, $counts): array {
                return [
                    'label' => Carbon::create($year, $month, 1)->format('M'),
                    'value' => (int) ($counts->get($month) ?? 0),
                ];
            })
            ->values()
            ->all();
    }

}
