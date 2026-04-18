<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Company;
use App\Models\JobListing;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_seekers' => User::where('role', 'seeker')->count(),
            'total_employers' => User::where('role', 'employer')->count(),
            'total_companies' => Company::count(),
            'total_jobs' => JobListing::count(),
            'active_jobs' => JobListing::where('is_active', true)->count(),
            'total_applications' => Application::count(),
        ];

        $recentUsers = User::latest()->take(10)->get();
        $recentJobs = JobListing::with('company')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentJobs'));
    }
}
