<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * Show the museum visitor feedback form.
     */
    public function create(): View
    {
        return view('feedback.create', [
            'ageRanges' => Feedback::ageRanges(),
            'genders' => Feedback::genders(),
            'residenceTypes' => Feedback::residenceTypes(),
            'overallExperiences' => Feedback::overallExperiences(),
        ]);
    }

    /**
     * Store a submitted visitor feedback response.
     */
    public function store(StoreFeedbackRequest $request): RedirectResponse
    {
        Feedback::create($request->validated());

        return redirect()
            ->route('home')
            ->with('status', 'Thank you for sharing your feedback!');
    }
}
