@extends('layouts.app')

@section('title', 'Register - Jobberman')

@section('content')
<section class="py-16 px-4">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-900">Create an Account</h1>
                <p class="text-slate-500 mt-2">Join Jobberman to find your dream job or hire top talent</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Role Selection -->
                <div class="mb-6">
                    <label class="text-sm font-medium text-slate-700 mb-3 block">I want to</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="seeker" class="peer hidden" {{ old('role', 'seeker') == 'seeker' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-slate-200 rounded-xl text-center peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                <i data-lucide="search" class="w-6 h-6 mx-auto mb-2 text-slate-400 peer-checked:text-primary"></i>
                                <p class="font-semibold text-sm text-slate-700">Find a Job</p>
                                <p class="text-xs text-slate-400">Job Seeker</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="employer" class="peer hidden" {{ old('role') == 'employer' ? 'checked' : '' }}>
                            <div class="p-4 border-2 border-slate-200 rounded-xl text-center peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                <i data-lucide="building-2" class="w-6 h-6 mx-auto mb-2 text-slate-400 peer-checked:text-primary"></i>
                                <p class="font-semibold text-sm text-slate-700">Hire Talent</p>
                                <p class="text-xs text-slate-400">Employer</p>
                            </div>
                        </label>
                    </div>
                    @error('role')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="text-sm font-medium text-slate-700 mb-1 block">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="text-sm font-medium text-slate-700 mb-1 block">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="text-sm font-medium text-slate-700 mb-1 block">Password</label>
                    <input id="password" type="password" name="password" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="text-sm font-medium text-slate-700 mb-1 block">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                    Create Account
                </button>

                <p class="text-center text-slate-500 text-sm mt-6">
                    Already have an account? <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Log In</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
