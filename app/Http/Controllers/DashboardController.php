<?php

namespace App\Http\Controllers;

use App\Support\DashboardSampleData;
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
            'feedbackByMonth' => DashboardSampleData::feedbackByMonth(),
            'profile' => $profile,
        ]);
    }
}
