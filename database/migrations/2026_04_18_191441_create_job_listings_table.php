<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('location');
            $table->enum('type', ['full-time', 'part-time', 'contract', 'remote'])->default('full-time');
            $table->string('salary_min')->nullable();
            $table->string('salary_max')->nullable();
            $table->string('currency', 10)->default('NGN');
            $table->string('industry')->nullable();
            $table->enum('experience_level', ['no-experience', 'entry', 'mid', 'senior', 'executive'])->default('entry');
            $table->boolean('is_active')->default(true);
            $table->timestamp('deadline')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
