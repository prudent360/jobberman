<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_listing_id',
        'user_id',
    ];

    /**
     * Get the job listing that was saved.
     */
    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }

    /**
     * Get the user who saved the job.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
