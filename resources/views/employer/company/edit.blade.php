@extends('layouts.app')

@section('title', 'Edit Company - Jobberman')

@section('content')
<section class="py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Edit Company Profile</h1>

        <form action="{{ route('employer.company.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-lg p-8 border border-slate-100">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Company Name *</label>
                    <input type="text" name="name" value="{{ old('name', $company->name) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Company Logo</label>
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="w-16 h-16 rounded-xl object-cover mb-2">
                    @endif
                    <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary">
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary resize-none">{{ old('description', $company->description) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Location</label>
                        <input type="text" name="location" value="{{ old('location', $company->location) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-700 mb-1 block">Industry</label>
                        <input type="text" name="industry" value="{{ old('industry', $company->industry) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-700 mb-1 block">Website</label>
                    <input type="url" name="website" value="{{ old('website', $company->website) }}" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                </div>
            </div>
            <div class="mt-8">
                <button type="submit" class="px-10 py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">Update Company</button>
            </div>
        </form>
    </div>
</section>
@endsection
