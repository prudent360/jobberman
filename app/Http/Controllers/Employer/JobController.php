<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Show employer's jobs.
     */
    public function index()
    {
        $company = auth()->user()->company;

        if (!$company) {
            return redirect()->route('employer.company.create');
        }

        $jobs = JobListing::where('company_id', $company->id)
            ->withCount('applications')
            ->latest()
            ->paginate(10);

        return view('employer.jobs.index', compact('jobs'));
    }

    /**
     * Show create job form.
     */
    public function create()
    {
        return view('employer.jobs.create');
    }

    /**
     * Store a new job listing.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract,remote',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'currency' => 'required|in:NGN,USD,GBP',
            'industry' => 'nullable|string|max:255',
            'experience_level' => 'required|in:no-experience,entry,mid,senior,executive',
            'deadline' => 'nullable|date|after:today',
        ]);

        $company = auth()->user()->company;

        $company->jobListings()->create($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job posted successfully!');
    }

    /**
     * Show edit job form.
     */
    public function edit(JobListing $jobListing)
    {
        $this->authorizeJob($jobListing);
        return view('employer.jobs.edit', compact('jobListing'));
    }

    /**
     * Update an existing job.
     */
    public function update(Request $request, JobListing $jobListing)
    {
        $this->authorizeJob($jobListing);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract,remote',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0',
            'currency' => 'required|in:NGN,USD,GBP',
            'industry' => 'nullable|string|max:255',
            'experience_level' => 'required|in:no-experience,entry,mid,senior,executive',
            'is_active' => 'boolean',
            'deadline' => 'nullable|date',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $jobListing->update($validated);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Delete a job listing.
     */
    public function destroy(JobListing $jobListing)
    {
        $this->authorizeJob($jobListing);

        $jobListing->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully!');
    }

    /**
     * View applicants for a job.
     */
    public function applicants(JobListing $jobListing)
    {
        $this->authorizeJob($jobListing);

        $applicants = Application::with('user')
            ->where('job_listing_id', $jobListing->id)
            ->latest()
            ->paginate(10);

        return view('employer.jobs.applicants', compact('jobListing', 'applicants'));
    }

    /**
     * Update application status.
     */
    public function updateApplicationStatus(Request $request, Application $application)
    {
        // Verify the employer owns this job
        $jobListing = $application->jobListing;
        $this->authorizeJob($jobListing);

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,rejected',
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Application status updated.');
    }

    /**
     * Ensure the employer owns this job.
     */
    private function authorizeJob(JobListing $jobListing): void
    {
        $company = auth()->user()->company;

        if (!$company || $jobListing->company_id !== $company->id) {
            abort(403, 'Unauthorized.');
        }
    }
}
