<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use App\Models\JobListing;

class SavedJobController extends Controller
{
    /**
     * Toggle save/unsave a job.
     */
    public function toggle(JobListing $jobListing)
    {
        $existing = SavedJob::where('job_listing_id', $jobListing->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Job removed from saved list.');
        }

        SavedJob::create([
            'job_listing_id' => $jobListing->id,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Job saved successfully!');
    }
}
