<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Show company creation form.
     */
    public function create()
    {
        // If company already exists, redirect to edit
        if (auth()->user()->company) {
            return redirect()->route('employer.company.edit');
        }

        return view('employer.company.create');
    }

    /**
     * Store a new company profile.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $validated['user_id'] = auth()->id();

        Company::create($validated);

        return redirect()->route('employer.dashboard')
            ->with('success', 'Company profile created successfully!');
    }

    /**
     * Show edit company form.
     */
    public function edit()
    {
        $company = auth()->user()->company;

        if (!$company) {
            return redirect()->route('employer.company.create');
        }

        return view('employer.company.edit', compact('company'));
    }

    /**
     * Update company profile.
     */
    public function update(Request $request)
    {
        $company = auth()->user()->company;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'industry' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($validated);

        return redirect()->route('employer.dashboard')
            ->with('success', 'Company profile updated successfully!');
    }
}
