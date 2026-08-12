<?php

namespace App\Support;

/**
 * Static sample data for the admin dashboard UI.
 * Replace method return values with database queries when backend is implemented.
 */
class DashboardSampleData
{
    /**
     * Monthly user feedback counts for the dashboard chart.
     *
     * @return list<array{label: string, value: int}>
     */
    public static function feedbackByMonth(): array
    {
        return [
            ['label' => 'Jan', 'value' => 20],
            ['label' => 'Feb', 'value' => 128],
            ['label' => 'Mar', 'value' => 25],
            ['label' => 'Apr', 'value' => 153],
            ['label' => 'May', 'value' => 167],
            ['label' => 'Jun', 'value' => 1],
            ['label' => 'Jul', 'value' => 189],
            ['label' => 'Aug', 'value' => 184],
        ];
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
            'last_login' => 'August 11, 2026',
        ];
    }
}
