<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use App\Support\DashboardData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the staff dashboard.
     */
    public function index(): View
    {
        $profile = auth()->user()->toProfileArray();

        return view('dashboard.index', [
            'summaryStats' => DashboardData::summaryStats(),
            'visitorsByMonth' => DashboardData::visitorsByMonth(),
            'feedbackByMonth' => DashboardData::feedbackByMonth(),
            'ratingDistribution' => DashboardData::ratingDistribution(),
            'recentFeedback' => DashboardData::recentFeedback(),
            'profile' => $profile,
        ]);
    }

    /**
     * Browse submitted visitor feedback.
     */
    public function feedback(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $experience = (string) $request->query('experience', '');

        $query = Feedback::query()->latest();

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('comments', 'like', "%{$search}%")
                    ->orWhere('residence_detail', 'like', "%{$search}%")
                    ->orWhere('gender_other', 'like', "%{$search}%");
            });
        }

        if ($experience !== '' && in_array($experience, Feedback::overallExperiences(), true)) {
            $query->where('overall_experience', $experience);
        }

        return view('dashboard.feedback', [
            'feedbacks' => $query->paginate(10)->withQueryString(),
            'filters' => [
                'search' => $search,
                'experience' => $experience,
            ],
            'profile' => auth()->user()->toProfileArray(),
        ]);
    }

    /**
     * Browse staff and administrator accounts.
     */
    public function users(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $role = (string) $request->query('role', '');
        $status = (string) $request->query('status', '');

        $query = User::query()->orderBy('first_name')->orderBy('last_name');

        if ($search !== '') {
            $query->where(function ($builder) use ($search): void {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($role !== '' && in_array($role, User::roles(), true)) {
            $query->where('role', $role);
        }

        if ($status !== '' && in_array($status, User::statuses(), true)) {
            $query->where('status', $status);
        }

        return view('dashboard.users', [
            'users' => $query->paginate(10)->withQueryString(),
            'filters' => [
                'search' => $search,
                'role' => $role,
                'status' => $status,
            ],
            'profile' => auth()->user()->toProfileArray(),
        ]);
    }
}
