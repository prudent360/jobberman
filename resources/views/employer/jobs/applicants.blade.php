@extends('layouts.app')

@section('title', 'Applicants for ' . $jobListing->title . ' - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-5xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('employer.jobs.index') }}" class="text-sm text-primary hover:underline mb-2 inline-block">&larr; Back to My Jobs</a>
            <h1 class="text-3xl font-bold text-slate-900">Applicants for "{{ $jobListing->title }}"</h1>
            <p class="text-slate-500 mt-1">{{ $applicants->total() }} total applicant{{ $applicants->total() != 1 ? 's' : '' }}</p>
        </div>

        <div class="space-y-4">
            @forelse($applicants as $app)
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                <span class="text-primary font-bold">{{ substr($app->user->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900">{{ $app->user->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $app->user->email }}</p>
                                <p class="text-xs text-slate-400 mt-1">Applied {{ $app->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-bold rounded-full {{ $app->status_color }}">{{ $app->status_badge }}</span>
                    </div>

                    @if($app->cover_letter)
                        <div class="mt-4 p-4 bg-slate-50 rounded-xl">
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Cover Letter</p>
                            <p class="text-sm text-slate-600">{{ $app->cover_letter }}</p>
                        </div>
                    @endif

                    <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            @if($app->resume_path)
                                <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="px-3 py-1.5 bg-slate-100 text-slate-600 text-sm font-medium rounded-lg hover:bg-slate-200 flex items-center gap-1">
                                    <i data-lucide="file-text" class="w-3 h-3"></i> View Resume
                                </a>
                            @endif
                        </div>
                        <form action="{{ route('employer.applications.status', $app) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="text-sm px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-lg focus:border-primary appearance-none">
                                @foreach(['pending', 'reviewed', 'shortlisted', 'rejected'] as $status)
                                    <option value="{{ $status }}" {{ $app->status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-4 py-1.5 bg-primary text-white text-sm font-bold rounded-lg hover:bg-primary-dark">Update</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-20">
                    <i data-lucide="users" class="w-20 h-20 text-slate-200 mx-auto mb-6"></i>
                    <h3 class="text-xl font-bold text-slate-700">No applicants yet</h3>
                    <p class="text-slate-500 mt-2">Applicants will appear here once people apply to this position</p>
                </div>
            @endforelse
        </div>

        @if($applicants->hasPages())
            <div class="mt-8">{{ $applicants->links() }}</div>
        @endif
    </div>
</section>
@endsection
