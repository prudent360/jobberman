<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $company = $user->company;

        if (!$company) {
            return redirect()->route('employer.company.create')
                ->with('info', 'Please set up your company profile first.');
        }

        $recentJobs = JobListing::where('company_id', $company->id)
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_jobs' => JobListing::where('company_id', $company->id)->count(),
            'active_jobs' => JobListing::where('company_id', $company->id)->where('is_active', true)->count(),
            'total_applications' => Application::whereIn('job_listing_id',
                JobListing::where('company_id', $company->id)->pluck('id')
            )->count(),
            'pending_applications' => Application::whereIn('job_listing_id',
                JobListing::where('company_id', $company->id)->pluck('id')
            )->where('status', 'pending')->count(),
        ];

        return view('employer.dashboard', compact('company', 'recentJobs', 'stats'));
    }
}
