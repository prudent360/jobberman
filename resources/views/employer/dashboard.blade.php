@extends('layouts.app')

@section('title', 'Employer Dashboard - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Employer Dashboard</h1>
                <p class="text-slate-500 mt-1">{{ $company->name }}</p>
            </div>
            <a href="{{ route('employer.jobs.create') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20 flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5"></i> Post New Job
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="briefcase" class="w-5 h-5 text-primary"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['total_jobs'] }}</p>
                <p class="text-sm text-slate-500">Total Jobs</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['active_jobs'] }}</p>
                <p class="text-sm text-slate-500">Active Jobs</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="users" class="w-5 h-5 text-blue-500"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['total_applications'] }}</p>
                <p class="text-sm text-slate-500">Applications</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="clock" class="w-5 h-5 text-yellow-500"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['pending_applications'] }}</p>
                <p class="text-sm text-slate-500">Pending Review</p>
            </div>
        </div>

        <!-- Recent Jobs -->
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-slate-900">Recent Job Postings</h2>
                <a href="{{ route('employer.jobs.index') }}" class="text-sm text-primary font-semibold hover:underline">View All</a>
            </div>
            @forelse($recentJobs as $job)
                <div class="flex items-center justify-between py-4 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                            <i data-lucide="file-text" class="w-5 h-5 text-primary"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $job->title }}</p>
                            <p class="text-xs text-slate-500">{{ $job->location }} · {{ ucfirst(str_replace('-', ' ', $job->type)) }} · {{ $job->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $job->is_active ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-500' }}">
                            {{ $job->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <a href="{{ route('employer.jobs.applicants', $job) }}" class="text-sm text-primary font-semibold hover:underline">Applicants</a>
                        <a href="{{ route('employer.jobs.edit', $job) }}" class="text-sm text-slate-500 hover:text-primary">Edit</a>
                    </div>
                </div>
            @empty
                <p class="text-slate-400 text-center py-8">No jobs posted yet. <a href="{{ route('employer.jobs.create') }}" class="text-primary font-semibold">Post your first job</a></p>
            @endforelse
        </div>
    </div>
</section>
@endsection
