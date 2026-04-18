@extends('layouts.app')

@section('title', 'Browse Jobs - Jobberman')

@section('content')
<section class="pt-8 pb-24 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Search & Filters -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-10 border border-slate-100">
            <form action="{{ route('jobs.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1 block">Keyword</label>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Job title or keyword..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1 block">Location</label>
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="City..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1 block">Job Type</label>
                        <select name="type" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            <option value="">All Types</option>
                            <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                            <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1 block">Level</label>
                        <select name="level" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary appearance-none">
                            <option value="">All Levels</option>
                            <option value="no-experience" {{ request('level') == 'no-experience' ? 'selected' : '' }}>No Experience</option>
                            <option value="entry" {{ request('level') == 'entry' ? 'selected' : '' }}>Entry Level</option>
                            <option value="mid" {{ request('level') == 'mid' ? 'selected' : '' }}>Mid Level</option>
                            <option value="senior" {{ request('level') == 'senior' ? 'selected' : '' }}>Senior Level</option>
                            <option value="executive" {{ request('level') == 'executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <button type="submit" class="px-8 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                        <i data-lucide="search" class="w-4 h-4 inline mr-2"></i> Search Jobs
                    </button>
                    @if(request()->hasAny(['keyword', 'location', 'type', 'level', 'industry']))
                        <a href="{{ route('jobs.index') }}" class="text-sm text-slate-500 hover:text-primary">Clear Filters</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Results Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-slate-900">
                @if(request()->hasAny(['keyword', 'location', 'type', 'level']))
                    Search Results
                @else
                    All Jobs
                @endif
                <span class="text-slate-400 text-lg font-normal">({{ $jobs->total() }} found)</span>
            </h1>
        </div>

        <!-- Job Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($jobs as $job)
                @include('jobs._card', ['job' => $job])
            @empty
                <div class="col-span-2 text-center py-20">
                    <i data-lucide="search-x" class="w-20 h-20 text-slate-200 mx-auto mb-6"></i>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">No jobs found</h3>
                    <p class="text-slate-500 mb-6">Try adjusting your search filters</p>
                    <a href="{{ route('jobs.index') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all inline-block">Browse All Jobs</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($jobs->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
