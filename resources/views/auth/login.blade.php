@extends('layouts.app')

@section('title', 'Log In - Jobberman')

@section('content')
<section class="py-16 px-4">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-3xl shadow-xl p-8 border border-slate-100">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-900">Welcome Back</h1>
                <p class="text-slate-500 mt-2">Log in to your Jobberman account</p>
            </div>

            @if(session('status'))
                <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-xl">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="text-sm font-medium text-slate-700 mb-1 block">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-primary">
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

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-slate-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">Forgot password?</a>
                    @endif
                </div>

                <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-xl hover:bg-primary-dark transition-all shadow-lg shadow-primary/20">
                    Log In
                </button>

                <p class="text-center text-slate-500 text-sm mt-6">
                    Don't have an account? <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Sign Up</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection
