@extends('layouts.app')

@section('title', 'Dashboard - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Welcome back, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-slate-500 mt-2">Here's an overview of your job search progress</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="send" class="w-5 h-5 text-primary"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['total_applications'] }}</p>
                <p class="text-sm text-slate-500">Applications</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="clock" class="w-5 h-5 text-yellow-500"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['pending'] }}</p>
                <p class="text-sm text-slate-500">Pending</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['shortlisted'] }}</p>
                <p class="text-sm text-slate-500">Shortlisted</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center mb-3">
                    <i data-lucide="x-circle" class="w-5 h-5 text-red-500"></i>
                </div>
                <p class="text-2xl font-bold text-slate-900">{{ $stats['rejected'] }}</p>
                <p class="text-sm text-slate-500">Not Selected</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Applications -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-slate-900">Recent Applications</h2>
                    <a href="{{ route('applications.index') }}" class="text-sm text-primary font-semibold hover:underline">View All</a>
                </div>
                @forelse($recentApplications as $app)
                    <div class="flex items-center gap-4 py-3 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                            <i data-lucide="briefcase" class="w-5 h-5 text-primary"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $app->jobListing->title ?? 'Job' }}</p>
                            <p class="text-xs text-slate-500">{{ $app->jobListing->company->name ?? '' }} · {{ $app->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $app->status_color }}">{{ $app->status_badge }}</span>
                    </div>
                @empty
                    <p class="text-slate-400 text-center py-8">No applications yet. <a href="{{ route('jobs.index') }}" class="text-primary font-semibold">Browse Jobs</a></p>
                @endforelse
            </div>

            <!-- Saved Jobs -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                <h2 class="text-lg font-bold text-slate-900 mb-6">Saved Jobs</h2>
                @forelse($savedJobs as $saved)
                    <div class="flex items-center gap-4 py-3 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                            <i data-lucide="heart" class="w-5 h-5 text-red-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('jobs.show', $saved->jobListing) }}" class="text-sm font-semibold text-slate-900 truncate hover:text-primary block">{{ $saved->jobListing->title ?? 'Job' }}</a>
                            <p class="text-xs text-slate-500">{{ $saved->jobListing->company->name ?? '' }} · {{ $saved->jobListing->location ?? '' }}</p>
                        </div>
                        <a href="{{ route('jobs.show', $saved->jobListing) }}" class="text-primary text-sm font-semibold">View</a>
                    </div>
                @empty
                    <p class="text-slate-400 text-center py-8">No saved jobs yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
