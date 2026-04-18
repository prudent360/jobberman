<?php

namespace App\Http\Controllers;

use App\Models\JobListing;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = JobListing::with('company')
            ->active()
            ->latest()
            ->take(6)
            ->get();

        $jobCounts = [
            'executive' => JobListing::active()->ofLevel('executive')->count(),
            'entry' => JobListing::active()->ofLevel('entry')->count(),
            'mid' => JobListing::active()->ofLevel('mid')->count(),
            'senior' => JobListing::active()->ofLevel('senior')->count(),
            'no-experience' => JobListing::active()->ofLevel('no-experience')->count(),
            'internship' => JobListing::active()->ofLevel('entry')->count(),
        ];

        return view('home', compact('featuredJobs', 'jobCounts'));
    }
}
