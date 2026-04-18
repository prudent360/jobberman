<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display all jobs with search & filter.
     */
    public function index(Request $request)
    {
        $jobs = JobListing::with('company')
            ->active()
            ->search($request->keyword)
            ->ofType($request->type)
            ->ofLevel($request->level)
            ->inLocation($request->location)
            ->inIndustry($request->industry)
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Display a single job listing.
     */
    public function show(JobListing $jobListing)
    {
        $jobListing->load('company', 'applications');

        $relatedJobs = JobListing::with('company')
            ->active()
            ->where('id', '!=', $jobListing->id)
            ->where(function ($q) use ($jobListing) {
                $q->where('industry', $jobListing->industry)
                  ->orWhere('location', $jobListing->location);
            })
            ->take(3)
            ->get();

        $hasApplied = false;
        $hasSaved = false;

        if (auth()->check()) {
            $hasApplied = $jobListing->applications()
                ->where('user_id', auth()->id())
                ->exists();
            $hasSaved = $jobListing->savedByUsers()
                ->where('user_id', auth()->id())
                ->exists();
        }

        return view('jobs.show', compact('jobListing', 'relatedJobs', 'hasApplied', 'hasSaved'));
    }
}
