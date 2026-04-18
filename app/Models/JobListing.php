<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JobListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'slug',
        'description',
        'location',
        'type',
        'salary_min',
        'salary_max',
        'currency',
        'industry',
        'experience_level',
        'is_active',
        'deadline',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'deadline' => 'datetime',
        ];
    }

    /**
     * Auto-generate slug from title on creation.
     */
    protected static function booted(): void
    {
        static::creating(function (JobListing $job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title) . '-' . Str::random(6);
            }
        });
    }

    /**
     * Get the company that posted this job.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get all applications for this job.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get all saves for this job.
     */
    public function savedByUsers(): HasMany
    {
        return $this->hasMany(SavedJob::class);
    }

    /**
     * Scope: only active jobs.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: search by keyword.
     */
    public function scopeSearch($query, ?string $keyword)
    {
        if ($keyword) {
            return $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%")
                  ->orWhere('location', 'like', "%{$keyword}%");
            });
        }
        return $query;
    }

    /**
     * Scope: filter by type.
     */
    public function scopeOfType($query, ?string $type)
    {
        if ($type) {
            return $query->where('type', $type);
        }
        return $query;
    }

    /**
     * Scope: filter by experience level.
     */
    public function scopeOfLevel($query, ?string $level)
    {
        if ($level) {
            return $query->where('experience_level', $level);
        }
        return $query;
    }

    /**
     * Scope: filter by location.
     */
    public function scopeInLocation($query, ?string $location)
    {
        if ($location) {
            return $query->where('location', 'like', "%{$location}%");
        }
        return $query;
    }

    /**
     * Scope: filter by industry.
     */
    public function scopeInIndustry($query, ?string $industry)
    {
        if ($industry) {
            return $query->where('industry', $industry);
        }
        return $query;
    }

    /**
     * Get formatted salary range.
     */
    public function getSalaryRangeAttribute(): string
    {
        if ($this->salary_min && $this->salary_max) {
            $symbol = $this->currency === 'NGN' ? '₦' : ($this->currency === 'USD' ? '$' : '£');
            return $symbol . number_format($this->salary_min) . ' - ' . $symbol . number_format($this->salary_max);
        }
        return 'Negotiable';
    }

    /**
     * Get human-readable posted time.
     */
    public function getPostedAtHumanAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Check if this is a new listing (posted within 48 hours).
     */
    public function getIsNewAttribute(): bool
    {
        return $this->created_at->isAfter(now()->subHours(48));
    }
}
