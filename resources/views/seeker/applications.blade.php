@extends('layouts.app')

@section('title', 'My Applications - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">My Applications</h1>

        <div class="space-y-4">
            @forelse($applications as $app)
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 hover:shadow-lg transition-all">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-100">
                            <i data-lucide="briefcase" class="w-6 h-6 text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900">{{ $app->jobListing->title ?? 'Job' }}</h3>
                                    <p class="text-slate-600">{{ $app->jobListing->company->name ?? '' }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-bold rounded-full {{ $app->status_color }}">{{ $app->status_badge }}</span>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-4 text-sm text-slate-500">
                                <span class="flex items-center"><i data-lucide="map-pin" class="w-3 h-3 mr-1"></i> {{ $app->jobListing->location ?? '' }}</span>
                                <span class="flex items-center"><i data-lucide="calendar" class="w-3 h-3 mr-1"></i> Applied {{ $app->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <i data-lucide="inbox" class="w-20 h-20 text-slate-200 mx-auto mb-6"></i>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">No applications yet</h3>
                    <p class="text-slate-500 mb-6">Start applying to jobs to track your applications here</p>
                    <a href="{{ route('jobs.index') }}" class="px-8 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all inline-block">Browse Jobs</a>
                </div>
            @endforelse
        </div>

        @if($applications->hasPages())
            <div class="mt-8">{{ $applications->links() }}</div>
        @endif
    </div>
</section>
@endsection
