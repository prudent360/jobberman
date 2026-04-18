@extends('layouts.app')

@section('title', 'Jobberman - Find Your Dream Job')

@section('content')
    <!-- Hero Section -->
    <section class="relative pt-16 pb-32 px-4 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary via-indigo-600 to-secondary opacity-95"></div>
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 40px 40px;"></div>

        <div class="relative max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-8 animate-slide-up">
                Explore and discover the <br class="hidden md:block"> <span class="text-blue-200">right job for you!</span>
            </h1>

            <!-- Search Bar -->
            <div class="max-w-5xl mx-auto mt-12 animate-slide-up" style="animation-delay: 0.1s">
                <form action="{{ route('jobs.index') }}" method="GET">
                    <div class="bg-white/10 backdrop-blur-md p-2 rounded-2xl md:rounded-full border border-white/20 shadow-2xl">
                        <div class="flex flex-col md:flex-row items-center gap-2">
                            <!-- Keyword Search -->
                            <div class="w-full md:flex-1 relative">
                                <div class="flex items-center px-6 py-4 rounded-xl md:rounded-full">
                                    <i data-lucide="search" class="w-5 h-5 text-white/70 mr-3"></i>
                                    <input type="text" name="keyword" placeholder="Job title or keyword..." class="bg-transparent text-white placeholder-white/50 w-full focus:outline-none font-medium">
                                </div>
                            </div>

                            <div class="hidden md:block w-px h-10 bg-white/20"></div>

                            <!-- Location -->
                            <div class="w-full md:flex-1 relative">
                                <div class="flex items-center px-6 py-4 rounded-xl md:rounded-full">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-white/70 mr-3"></i>
                                    <input type="text" name="location" placeholder="Location..." class="bg-transparent text-white placeholder-white/50 w-full focus:outline-none font-medium">
                                </div>
                            </div>

                            <div class="hidden md:block w-px h-10 bg-white/20"></div>

                            <!-- Job Type -->
                            <div class="w-full md:flex-1 relative">
                                <div class="flex items-center px-6 py-4 rounded-xl md:rounded-full">
                                    <i data-lucide="briefcase" class="w-5 h-5 text-white/70 mr-3"></i>
                                    <select name="type" class="bg-transparent text-white w-full focus:outline-none font-medium appearance-none cursor-pointer">
                                        <option value="" class="text-slate-900">All Types</option>
                                        <option value="full-time" class="text-slate-900">Full Time</option>
                                        <option value="part-time" class="text-slate-900">Part Time</option>
                                        <option value="contract" class="text-slate-900">Contract</option>
                                        <option value="remote" class="text-slate-900">Remote</option>
                                    </select>
                                </div>
                            </div>

                            <!-- CTA -->
                            <button type="submit" class="w-full md:w-auto px-10 py-5 bg-white text-primary font-bold rounded-xl md:rounded-full shadow-xl hover:bg-slate-50 hover:scale-105 transition-all duration-300">
                                Find a Job
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Popular Searches -->
    <section class="max-w-7xl mx-auto px-4 -mt-10 relative z-10">
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col md:flex-row items-center gap-6 border border-slate-100">
            <span class="text-slate-500 font-medium whitespace-nowrap">Popular Searches:</span>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('jobs.index', ['industry' => 'Hospitality']) }}" class="px-4 py-2 bg-slate-50 hover:bg-primary/10 hover:text-primary text-slate-600 text-sm rounded-full border border-slate-200 transition-all">Hospitality & Hotel</a>
                <a href="{{ route('jobs.index', ['location' => 'Lagos']) }}" class="px-4 py-2 bg-slate-50 hover:bg-primary/10 hover:text-primary text-slate-600 text-sm rounded-full border border-slate-200 transition-all">Lagos</a>
                <a href="{{ route('jobs.index', ['industry' => 'Banking']) }}" class="px-4 py-2 bg-slate-50 hover:bg-primary/10 hover:text-primary text-slate-600 text-sm rounded-full border border-slate-200 transition-all">Banking, Finance & Insurance</a>
                <a href="{{ route('jobs.index', ['type' => 'full-time']) }}" class="px-4 py-2 bg-slate-50 hover:bg-primary/10 hover:text-primary text-slate-600 text-sm rounded-full border border-slate-200 transition-all">Full Time</a>
                <a href="{{ route('jobs.index', ['type' => 'remote']) }}" class="px-4 py-2 bg-slate-50 hover:bg-primary/10 hover:text-primary text-slate-600 text-sm rounded-full border border-slate-200 transition-all">Remote</a>
            </div>
        </div>
    </section>

    <!-- Job Vacancies / Categories -->
    <section class="max-w-7xl mx-auto px-4 py-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Find the right job vacancies</h2>
            <p class="text-slate-500 text-lg">Experience-based filtering to help you land the perfect role</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $categories = [
                    ['level' => 'executive', 'title' => 'Executive level', 'icon' => 'crown', 'bg' => 'indigo', 'color' => 'primary'],
                    ['level' => 'entry', 'title' => 'Internship & Graduate', 'icon' => 'graduation-cap', 'bg' => 'blue', 'color' => 'secondary'],
                    ['level' => 'senior', 'title' => 'Senior level', 'icon' => 'award', 'bg' => 'purple', 'color' => 'purple-600'],
                    ['level' => 'mid', 'title' => 'Mid level', 'icon' => 'trending-up', 'bg' => 'emerald', 'color' => 'emerald-600'],
                    ['level' => 'entry', 'title' => 'Entry level', 'icon' => 'rocket', 'bg' => 'orange', 'color' => 'orange-600'],
                    ['level' => 'no-experience', 'title' => 'No Experience', 'icon' => 'sparkles', 'bg' => 'pink', 'color' => 'pink-600'],
                ];
            @endphp

            @foreach($categories as $cat)
                <a href="{{ route('jobs.index', ['level' => $cat['level']]) }}" class="group bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 bg-{{ $cat['bg'] }}-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-{{ $cat['color'] }} transition-colors">
                        <i data-lucide="{{ $cat['icon'] }}" class="w-7 h-7 text-{{ $cat['color'] }} group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $cat['title'] }}</h3>
                    <p class="text-slate-500 mb-6">{{ $jobCounts[$cat['level']] ?? 0 }}+ Active Jobs</p>
                    <span class="inline-flex items-center font-semibold text-primary">
                        Explore Jobs <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                    </span>
                </a>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('jobs.index') }}" class="px-10 py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all shadow-xl shadow-slate-200 inline-block">
                Explore All Categories
            </a>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="bg-white py-24 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="text-left">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Featured Jobs</h2>
                    <p class="text-slate-500 text-lg">Hand-picked opportunities from top-tier companies</p>
                </div>
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center font-semibold text-primary hover:underline">
                    View all jobs <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($featuredJobs as $job)
                    @include('jobs._card', ['job' => $job])
                @empty
                    <div class="col-span-2 text-center py-12">
                        <i data-lucide="briefcase" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
                        <p class="text-slate-500 text-lg">No jobs posted yet. Check back soon!</p>
                    </div>
                @endforelse
            </div>

            @if($featuredJobs->count() > 0)
                <div class="mt-16 text-center">
                    <a href="{{ route('jobs.index') }}" class="px-10 py-4 bg-primary text-white font-bold rounded-2xl hover:bg-primary-dark transition-all shadow-xl shadow-primary/20 inline-block">
                        View More Jobs
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
