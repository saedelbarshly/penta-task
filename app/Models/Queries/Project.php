<?php

namespace App\Models\Queries;

use App\Models\Queries\Job;
use App\Models\Queries\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'account_id'];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }
}
