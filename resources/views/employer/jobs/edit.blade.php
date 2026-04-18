@extends('layouts.app')

@section('title', 'Edit Job - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Edit Job: {{ $jobListing->title }}</h1>

        <form action="{{ route('employer.jobs.update', $jobListing) }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Job Title *</label>
                    <input type="text" name="title" value="{{ old('title', $jobListing->title) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Job Description *</label>
                    <textarea name="description" rows="8" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary resize-none">{{ old('description', $jobListing->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Location *</label>
                        <input type="text" name="location" value="{{ old('location', $jobListing->location) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Job Type *</label>
                        <select name="type" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            @foreach(['full-time', 'part-time', 'contract', 'remote'] as $type)
                                <option value="{{ $type }}" {{ old('type', $jobListing->type) == $type ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $type)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Min Salary</label>
                        <input type="number" name="salary_min" value="{{ old('salary_min', $jobListing->salary_min) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Max Salary</label>
                        <input type="number" name="salary_max" value="{{ old('salary_max', $jobListing->salary_max) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Currency</label>
                        <select name="currency" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            @foreach(['NGN' => '₦ NGN', 'USD' => '$ USD', 'GBP' => '£ GBP'] as $code => $label)
                                <option value="{{ $code }}" {{ old('currency', $jobListing->currency) == $code ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Experience Level *</label>
                        <select name="experience_level" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            @foreach(['no-experience', 'entry', 'mid', 'senior', 'executive'] as $level)
                                <option value="{{ $level }}" {{ old('experience_level', $jobListing->experience_level) == $level ? 'selected' : '' }}>{{ ucfirst(str_replace('-', ' ', $level)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Industry</label>
                        <input type="text" name="industry" value="{{ old('industry', $jobListing->industry) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline', $jobListing->deadline?->format('Y-m-d')) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                </div>

                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $jobListing->is_active) ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary">
                        <span class="text-sm font-medium text-slate-700">Job is active and visible to seekers</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">Update Job</button>
                <a href="{{ route('employer.jobs.index') }}" class="text-slate-500 hover:text-slate-700">Cancel</a>
            </div>
        </form>

        <!-- Delete -->
        <div class="mt-6 bg-white rounded-2xl shadow-lg p-6 border border-red-100">
            <h3 class="text-lg font-bold text-red-600 mb-2">Danger Zone</h3>
            <p class="text-sm text-slate-500 mb-4">Deleting a job will remove it and all associated applications permanently.</p>
            <form action="{{ route('employer.jobs.destroy', $jobListing) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition-all">Delete Job</button>
            </form>
        </div>
    </div>
</section>
@endsection
