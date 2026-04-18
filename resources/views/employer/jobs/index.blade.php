@extends('layouts.app')

@section('title', 'My Jobs - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-slate-900">My Job Postings</h1>
            <a href="{{ route('employer.jobs.create') }}" class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all flex items-center gap-2">
                <i data-lucide="plus" class="w-5 h-5"></i> Post New Job
            </a>
        </div>

        <div class="space-y-4">
            @forelse($jobs as $job)
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100 hover:shadow-lg transition-all">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">{{ $job->title }}</h3>
                            <div class="flex flex-wrap gap-3 mt-2 text-sm text-slate-500">
                                <span class="flex items-center"><i data-lucide="map-pin" class="w-3 h-3 mr-1"></i> {{ $job->location }}</span>
                                <span>{{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                                <span>{{ $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-3 py-1 text-xs font-bold rounded-full {{ $job->is_active ? 'bg-green-50 text-green-600' : 'bg-slate-100 text-slate-500' }}">
                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                            </span>
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-blue-50 text-blue-600">
                                {{ $job->applications_count }} applicant{{ $job->applications_count != 1 ? 's' : '' }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-50 flex items-center gap-4">
                        <a href="{{ route('employer.jobs.applicants', $job) }}" class="text-sm font-semibold text-primary hover:underline">View Applicants</a>
                        <a href="{{ route('employer.jobs.edit', $job) }}" class="text-sm text-slate-500 hover:text-primary">Edit</a>
                        <a href="{{ route('jobs.show', $job) }}" class="text-sm text-slate-500 hover:text-primary">Preview</a>
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <i data-lucide="file-plus" class="w-20 h-20 text-slate-200 mx-auto mb-6"></i>
                    <h3 class="text-xl font-bold text-slate-700 mb-2">No jobs posted yet</h3>
                    <a href="{{ route('employer.jobs.create') }}" class="px-8 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all inline-block mt-4">Post Your First Job</a>
                </div>
            @endforelse
        </div>

        @if($jobs->hasPages())
            <div class="mt-8">{{ $jobs->links() }}</div>
        @endif
    </div>
</section>
@endsection
