<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\Employer;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{jobListing}', [JobController::class, 'show'])->name('jobs.show');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (All users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Profile (from Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Job actions for seekers
    Route::post('/jobs/{jobListing}/apply', [ApplicationController::class, 'store'])->name('jobs.apply');
    Route::post('/jobs/{jobListing}/save', [SavedJobController::class, 'toggle'])->name('jobs.save');
});

/*
|--------------------------------------------------------------------------
| Seeker Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-applications', [ApplicationController::class, 'index'])->name('applications.index');
});

/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [Employer\DashboardController::class, 'index'])->name('dashboard');

    // Company profile
    Route::get('/company/create', [Employer\CompanyController::class, 'create'])->name('company.create');
    Route::post('/company', [Employer\CompanyController::class, 'store'])->name('company.store');
    Route::get('/company/edit', [Employer\CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/company', [Employer\CompanyController::class, 'update'])->name('company.update');

    // Job management
    Route::get('/jobs', [Employer\JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [Employer\JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [Employer\JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{jobListing}/edit', [Employer\JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{jobListing}', [Employer\JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{jobListing}', [Employer\JobController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/{jobListing}/applicants', [Employer\JobController::class, 'applicants'])->name('jobs.applicants');
    Route::patch('/applications/{application}/status', [Employer\JobController::class, 'updateApplicationStatus'])->name('applications.status');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
