<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile page.
     */
    public function index(): View
    {
        $user = auth()->user();

        return view('profile.index', [
            'user' => $user,
            'profile' => $user->toProfileArray(),
        ]);
    }

    /**
     * Update the authenticated user's personal information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->update($request->validated());

        return redirect()
            ->route('profile')
            ->with('profile_status', 'Profile updated successfully.');
    }

    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->update([
            'password' => $request->validated('password'),
            'password_changed_at' => now(),
        ]);

        Auth::logoutOtherDevices($request->validated('current_password'));

        return redirect()
            ->route('profile')
            ->with('password_status', 'Password updated successfully.');
    }
}
