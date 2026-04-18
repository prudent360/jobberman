{{-- Reusable Job Card Component --}}
<div class="group bg-slate-50 border border-slate-100 p-6 rounded-2xl hover:bg-white hover:shadow-xl hover:border-primary/20 transition-all duration-300">
    <div class="flex items-start gap-4">
        <div class="w-14 h-14 bg-white rounded-xl shadow-sm flex items-center justify-center border border-slate-100 group-hover:border-primary/20 transition-all">
            @if($job->company && $job->company->logo)
                <img src="{{ asset('storage/' . $job->company->logo) }}" alt="{{ $job->company->name }}" class="w-10 h-10 rounded-lg object-cover">
            @else
                <i data-lucide="briefcase" class="w-7 h-7 text-primary"></i>
            @endif
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between mb-1">
                <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors">
                    <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                </h3>
                @if($job->is_new)
                    <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">New</span>
                @endif
            </div>
            <p class="text-slate-600 font-medium mb-4">{{ $job->company->name ?? 'Company' }}</p>

            <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-sm text-slate-500">
                <span class="flex items-center"><i data-lucide="map-pin" class="w-4 h-4 mr-1"></i> {{ $job->location }}</span>
                <span class="flex items-center"><i data-lucide="clock" class="w-4 h-4 mr-1"></i> {{ ucfirst(str_replace('-', ' ', $job->type)) }}</span>
                <span class="flex items-center font-semibold text-slate-700"><i data-lucide="banknote" class="w-4 h-4 mr-1"></i> {{ $job->salary_range }}</span>
            </div>
        </div>
    </div>
    <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
        <span class="text-xs text-slate-400">Posted {{ $job->posted_at_human }}</span>
        <a href="{{ route('jobs.show', $job) }}" class="text-sm font-bold text-primary hover:text-primary-dark flex items-center">
            Quick Apply <i data-lucide="chevron-right" class="w-4 h-4 ml-1"></i>
        </a>
    </div>
</div>
