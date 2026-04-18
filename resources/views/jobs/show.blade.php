@extends('layouts.app')

@section('title', $jobListing->title . ' - Jobberman')

@section('content')
<section class="pt-8 pb-24 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Job Header -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100 mb-8">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100">
                            @if($jobListing->company && $jobListing->company->logo)
                                <img src="{{ asset('storage/' . $jobListing->company->logo) }}" alt="{{ $jobListing->company->name }}" class="w-12 h-12 rounded-xl object-cover">
                            @else
                                <i data-lucide="building-2" class="w-8 h-8 text-primary"></i>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-2">{{ $jobListing->title }}</h1>
                            <p class="text-lg text-primary font-semibold mb-4">{{ $jobListing->company->name ?? 'Company' }}</p>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="px-3 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full">{{ ucfirst(str_replace('-', ' ', $jobListing->type)) }}</span>
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 text-sm font-medium rounded-full flex items-center"><i data-lucide="map-pin" class="w-3 h-3 mr-1"></i> {{ $jobListing->location }}</span>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-sm font-bold rounded-full">{{ $jobListing->salary_range }}</span>
                                @if($jobListing->is_new)
                                    <span class="px-3 py-1 bg-orange-50 text-orange-600 text-sm font-bold rounded-full">New</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Job Description</h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! nl2br(e($jobListing->description)) !!}
                    </div>

                    <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Experience</p>
                            <p class="text-sm font-semibold text-slate-700">{{ ucfirst(str_replace('-', ' ', $jobListing->experience_level)) }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Industry</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $jobListing->industry ?? 'General' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Posted</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $jobListing->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Deadline</p>
                            <p class="text-sm font-semibold text-slate-700">{{ $jobListing->deadline ? $jobListing->deadline->format('M d, Y') : 'Open' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Apply Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100 sticky top-24">
                    @auth
                        @if($hasApplied)
                            <div class="text-center py-4">
                                <div class="w-16 h-16 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="check-circle" class="w-8 h-8 text-green-500"></i>
                                </div>
                                <p class="text-green-600 font-bold">Application Submitted!</p>
                                <p class="text-slate-500 text-sm mt-1">You've already applied to this job.</p>
                            </div>
                        @elseif(auth()->user()->isSeeker())
                            <h3 class="text-lg font-bold text-slate-900 mb-4">Apply for this job</h3>
                            <form action="{{ route('jobs.apply', $jobListing) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="text-sm font-medium text-slate-700 mb-1 block">Cover Letter <span class="text-slate-400">(optional)</span></label>
                                    <textarea name="cover_letter" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary resize-none" placeholder="Tell the employer why you're a great fit...">{{ old('cover_letter') }}</textarea>
                                    @error('cover_letter')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="text-sm font-medium text-slate-700 mb-1 block">Resume <span class="text-slate-400">(PDF, DOC — max 5MB)</span></label>
                                    <input type="file" name="resume" accept=".pdf,.doc,.docx" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                    @error('resume')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                                    Submit Application
                                </button>
                            </form>
                        @endif

                        @if(auth()->user()->isSeeker())
                            <form action="{{ route('jobs.save', $jobListing) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="w-full py-3 border-2 {{ $hasSaved ? 'border-primary bg-primary/5 text-primary' : 'border-slate-200 text-slate-600' }} font-semibold rounded-xl hover:border-primary hover:text-primary transition-all flex items-center justify-center gap-2">
                                    <i data-lucide="{{ $hasSaved ? 'heart' : 'heart' }}" class="w-4 h-4 {{ $hasSaved ? 'fill-primary' : '' }}"></i>
                                    {{ $hasSaved ? 'Saved' : 'Save Job' }}
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <p class="text-slate-600 mb-4">Log in to apply for this job</p>
                            <a href="{{ route('login') }}" class="block w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20 text-center">
                                Log In to Apply
                            </a>
                            <p class="text-slate-500 text-sm mt-3">Don't have an account? <a href="{{ route('register') }}" class="text-primary font-semibold">Sign Up</a></p>
                        </div>
                    @endauth
                </div>

                <!-- Company Info -->
                @if($jobListing->company)
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">About {{ $jobListing->company->name }}</h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-4">{{ $jobListing->company->description ?? 'No description available.' }}</p>
                    @if($jobListing->company->location)
                        <p class="text-slate-500 text-sm flex items-center"><i data-lucide="map-pin" class="w-4 h-4 mr-2"></i> {{ $jobListing->company->location }}</p>
                    @endif
                    @if($jobListing->company->website)
                        <a href="{{ $jobListing->company->website }}" target="_blank" class="text-primary text-sm flex items-center mt-2 hover:underline"><i data-lucide="globe" class="w-4 h-4 mr-2"></i> Visit Website</a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <!-- Related Jobs -->
        @if($relatedJobs->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Similar Jobs</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedJobs as $job)
                    @include('jobs._card', ['job' => $job])
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
