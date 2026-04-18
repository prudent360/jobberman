@extends('layouts.app')

@section('title', 'Set Up Your Company - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Set Up Your Company Profile</h1>
        <p class="text-slate-500 mb-8">Tell us about your company so job seekers can learn more</p>

        <form action="{{ route('employer.company.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Company Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. Paystack">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Company Logo</label>
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary resize-none" placeholder="What does your company do?">{{ old('description') }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. Lagos, Nigeria">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Industry</label>
                        <input type="text" name="industry" value="{{ old('industry') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="e.g. Technology">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Website</label>
                    <input type="url" name="website" value="{{ old('website') }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary" placeholder="https://example.com">
                </div>
            </div>
            <div class="mt-8">
                <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">Save & Continue</button>
            </div>
        </form>
    </div>
</section>
@endsection
