@extends('layouts.app')

@section('title', 'Post a Job - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Post a New Job</h1>

        <form action="{{ route('employer.jobs.store') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Job Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. Senior Product Designer">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Job Description *</label>
                    <textarea name="description" rows="8" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary resize-none" placeholder="Describe the role, responsibilities, requirements...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Location *</label>
                        <input type="text" name="location" value="{{ old('location') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. Lagos, Nigeria">
                        @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Job Type *</label>
                        <select name="type" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            <option value="full-time" {{ old('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ old('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ old('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="remote" {{ old('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Min Salary</label>
                        <input type="number" name="salary_min" value="{{ old('salary_min') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. 300000">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Max Salary</label>
                        <input type="number" name="salary_max" value="{{ old('salary_max') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. 600000">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Currency</label>
                        <select name="currency" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            <option value="NGN" {{ old('currency') == 'NGN' ? 'selected' : '' }}>₦ NGN</option>
                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>$ USD</option>
                            <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>£ GBP</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Experience Level *</label>
                        <select name="experience_level" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            <option value="no-experience" {{ old('experience_level') == 'no-experience' ? 'selected' : '' }}>No Experience</option>
                            <option value="entry" {{ old('experience_level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid" {{ old('experience_level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior" {{ old('experience_level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                            <option value="executive" {{ old('experience_level') == 'executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Industry</label>
                        <input type="text" name="industry" value="{{ old('industry') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. Technology">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Application Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                    Publish Job
                </button>
                <a href="{{ route('employer.dashboard') }}" class="text-slate-500 hover:text-slate-700">Cancel</a>
            </div>
        </form>
    </div>
</section>
@endsection
