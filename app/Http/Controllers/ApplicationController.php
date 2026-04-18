<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Show seeker's applications.
     */
    public function index()
    {
        $applications = Application::with('jobListing.company')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('seeker.applications', compact('applications'));
    }

    /**
     * Apply to a job.
     */
    public function store(Request $request, JobListing $jobListing)
    {
        $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Check if already applied
        $existing = Application::where('job_listing_id', $jobListing->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already applied to this job.');
        }

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        Application::create([
            'job_listing_id' => $jobListing->id,
            'user_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'resume_path' => $resumePath,
        ]);

        return redirect()->route('jobs.show', $jobListing)
            ->with('success', 'Application submitted successfully!');
    }
}
