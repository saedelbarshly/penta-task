<?php

namespace App\Models\Queries;

use App\Models\Queries\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'job_id'];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
}
