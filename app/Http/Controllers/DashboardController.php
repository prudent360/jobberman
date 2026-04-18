<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\SavedJob;

class DashboardController extends Controller
{
    /**
     * Seeker dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        $recentApplications = Application::with('jobListing.company')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $savedJobs = SavedJob::with('jobListing.company')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_applications' => Application::where('user_id', $user->id)->count(),
            'pending' => Application::where('user_id', $user->id)->where('status', 'pending')->count(),
            'shortlisted' => Application::where('user_id', $user->id)->where('status', 'shortlisted')->count(),
            'rejected' => Application::where('user_id', $user->id)->where('status', 'rejected')->count(),
        ];

        return view('seeker.dashboard', compact('recentApplications', 'savedJobs', 'stats'));
    }
}
