@extends('layouts.app')

@section('title', 'Admin Dashboard - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Admin Dashboard</h1>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            @php
                $adminStats = [
                    ['label' => 'Total Users', 'value' => $stats['total_users'], 'icon' => 'users', 'color' => 'primary'],
                    ['label' => 'Job Seekers', 'value' => $stats['total_seekers'], 'icon' => 'search', 'color' => 'blue-500'],
                    ['label' => 'Employers', 'value' => $stats['total_employers'], 'icon' => 'building-2', 'color' => 'emerald-500'],
                    ['label' => 'Active Jobs', 'value' => $stats['active_jobs'], 'icon' => 'briefcase', 'color' => 'orange-500'],
                ];
            @endphp
            @foreach($adminStats as $stat)
                <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                    <div class="w-10 h-10 bg-{{ $stat['color'] }}/10 rounded-xl flex items-center justify-center mb-3">
                        <i data-lucide="{{ $stat['icon'] }}" class="w-5 h-5 text-{{ $stat['color'] }}"></i>
                    </div>
                    <p class="text-2xl font-bold text-slate-900">{{ $stat['value'] }}</p>
                    <p class="text-sm text-slate-500">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Users -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                <h2 class="text-lg font-bold text-slate-900 mb-6">Recent Users</h2>
                @foreach($recentUsers as $user)
                    <div class="flex items-center gap-4 py-3 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="text-primary font-bold text-sm">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-900">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $user->role == 'employer' ? 'bg-blue-50 text-blue-600' : ($user->role == 'admin' ? 'bg-purple-50 text-purple-600' : 'bg-slate-100 text-slate-600') }}">{{ ucfirst($user->role) }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Recent Jobs -->
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-slate-100">
                <h2 class="text-lg font-bold text-slate-900 mb-6">Recent Jobs</h2>
                @foreach($recentJobs as $job)
                    <div class="flex items-center gap-4 py-3 {{ !$loop->last ? 'border-b border-slate-50' : '' }}">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center">
                            <i data-lucide="file-text" class="w-5 h-5 text-primary"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-900">{{ $job->title }}</p>
                            <p class="text-xs text-slate-500">{{ $job->company->name ?? '' }} · {{ $job->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs font-bold rounded-full {{ $job->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">{{ $job->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
