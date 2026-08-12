<?php

namespace App\Support;

use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardData
{
    /**
     * Summary stats for the dashboard cards.
     *
     * @return list<array{value: string, label: string, change: string|null, icon: string}>
     */
    public static function stats(): array
    {
        $now = now();
        $total = Feedback::count();
        $thisMonthCount = Feedback::query()
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();
        $lastMonth = $now->copy()->subMonth();
        $lastMonthCount = Feedback::query()
            ->whereYear('created_at', $lastMonth->year)
            ->whereMonth('created_at', $lastMonth->month)
            ->count();

        $averageRating = Feedback::averageExperienceScore();
        $thisMonthRating = Feedback::averageExperienceScore(
            Feedback::query()
                ->whereYear('created_at', $now->year)
                ->whereMonth('created_at', $now->month)
        );
        $lastMonthRating = Feedback::averageExperienceScore(
            Feedback::query()
                ->whereYear('created_at', $lastMonth->year)
                ->whereMonth('created_at', $lastMonth->month)
        );

        return [
            [
                'value' => number_format($total),
                'label' => 'Total Feedback',
                'change' => self::formatCountChange($thisMonthCount, $lastMonthCount),
                'icon' => 'message-square',
            ],
            [
                'value' => $averageRating !== null ? number_format($averageRating, 1) : '—',
                'label' => 'Average Rating',
                'change' => self::formatRatingChange($thisMonthRating, $lastMonthRating),
                'icon' => 'star',
            ],
            [
                'value' => number_format($thisMonthCount),
                'label' => 'This Month',
                'change' => $now->format('F Y'),
                'icon' => 'calendar',
            ],
        ];
    }

    /**
     * Monthly feedback counts for the dashboard chart (current year, Jan through current month).
     *
     * @return list<array{label: string, value: int}>
     */
    public static function feedbackByMonth(): array
    {
        $year = now()->year;

        return Collection::range(1, now()->month)
            ->map(function (int $month) use ($year): array {
                return [
                    'label' => Carbon::create($year, $month, 1)->format('M'),
                    'value' => Feedback::query()
                        ->whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->count(),
                ];
            })
            ->values()
            ->all();
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

    private static function formatCountChange(int $current, int $previous): ?string
    {
        if ($current === 0 && $previous === 0) {
            return null;
        }

        if ($previous === 0) {
            return $current > 0 ? 'New this month' : null;
        }

        $change = (($current - $previous) / $previous) * 100;
        $prefix = $change >= 0 ? '+' : '';

        return sprintf('%s%.0f%% from last month', $prefix, $change);
    }

    private static function formatRatingChange(?float $current, ?float $previous): ?string
    {
        if ($current === null && $previous === null) {
            return null;
        }

        if ($current === null || $previous === null) {
            return 'Not enough data yet';
        }

        $change = round($current - $previous, 1);

        if ($change === 0.0) {
            return 'No change from last month';
        }

        $prefix = $change > 0 ? '+' : '';

        return sprintf('%s%s from last month', $prefix, number_format($change, 1));
    }
}
