<?php

namespace App\Support;

use Carbon\Carbon;

class ReportPeriod
{
    public const TODAY = 'today';

    public const THIS_WEEK = 'this_week';

    public const THIS_MONTH = 'this_month';

    public const LAST_MONTH = 'last_month';

    public const LAST_3_MONTHS = 'last_3_months';

    public const LAST_6_MONTHS = 'last_6_months';

    public const THIS_YEAR = 'this_year';

    public const CUSTOM = 'custom';

    /**
     * @return list<string>
     */
    public static function options(): array
    {
        return [
            self::TODAY,
            self::THIS_WEEK,
            self::THIS_MONTH,
            self::LAST_MONTH,
            self::LAST_3_MONTHS,
            self::LAST_6_MONTHS,
            self::THIS_YEAR,
            self::CUSTOM,
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::TODAY => 'Today',
            self::THIS_WEEK => 'This Week',
            self::THIS_MONTH => 'This Month',
            self::LAST_MONTH => 'Last Month',
            self::LAST_3_MONTHS => 'Last 3 Months',
            self::LAST_6_MONTHS => 'Last 6 Months',
            self::THIS_YEAR => 'This Year',
            self::CUSTOM => 'Custom Date Range',
        ];
    }

    /**
     * Resolve a reporting period into start/end dates.
     *
     * @return array{start: Carbon, end: Carbon, key: string, label: string}
     */
    public static function resolve(
        string $period = self::THIS_MONTH,
        ?string $startDate = null,
        ?string $endDate = null,
    ): array {
        $now = now();
        $key = in_array($period, self::options(), true) ? $period : self::THIS_MONTH;

        [$start, $end] = match ($key) {
            self::TODAY => [$now->copy()->startOfDay(), $now->copy()->endOfDay()],
            self::THIS_WEEK => [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()],
            self::THIS_MONTH => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
            self::LAST_MONTH => [
                $now->copy()->subMonth()->startOfMonth(),
                $now->copy()->subMonth()->endOfMonth(),
            ],
            self::LAST_3_MONTHS => [
                $now->copy()->subMonths(2)->startOfMonth(),
                $now->copy()->endOfMonth(),
            ],
            self::LAST_6_MONTHS => [
                $now->copy()->subMonths(5)->startOfMonth(),
                $now->copy()->endOfMonth(),
            ],
            self::THIS_YEAR => [$now->copy()->startOfYear(), $now->copy()->endOfYear()],
            self::CUSTOM => self::resolveCustomRange($startDate, $endDate, $now),
            default => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()],
        };

        return [
            'start' => $start->startOfDay(),
            'end' => $end->endOfDay(),
            'key' => $key,
            'label' => self::labels()[$key],
        ];
    }

    /**
     * @return array{0: Carbon, 1: Carbon}
     */
    private static function resolveCustomRange(?string $startDate, ?string $endDate, Carbon $fallback): array
    {
        try {
            $start = $startDate ? Carbon::parse($startDate)->startOfDay() : $fallback->copy()->startOfMonth();
            $end = $endDate ? Carbon::parse($endDate)->endOfDay() : $fallback->copy()->endOfDay();
        } catch (\Throwable) {
            $start = $fallback->copy()->startOfMonth();
            $end = $fallback->copy()->endOfDay();
        }

        if ($start->greaterThan($end)) {
            [$start, $end] = [$end->copy()->startOfDay(), $start->copy()->endOfDay()];
        }

        return [$start, $end];
    }

    public static function formattedRange(Carbon $start, Carbon $end): string
    {
        if ($start->isSameDay($end)) {
            return $start->format('F j, Y');
        }

        if ($start->year === $end->year) {
            if ($start->month === $end->month) {
                return $start->format('F j').' – '.$end->format('j, Y');
            }

            return $start->format('F j').' – '.$end->format('F j, Y');
        }

        return $start->format('F j, Y').' – '.$end->format('F j, Y');
    }
}
