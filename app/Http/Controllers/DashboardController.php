<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
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
            'stats' => DashboardData::stats(),
            'feedbackByMonth' => DashboardData::feedbackByMonth(),
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
            'feedbacks' => $query->paginate(1)->withQueryString(),
            'filters' => [
                'search' => $search,
                'experience' => $experience,
            ],
            'profile' => auth()->user()->toProfileArray(),
        ]);
    }
}
