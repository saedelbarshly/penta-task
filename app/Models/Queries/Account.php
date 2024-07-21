<?php

namespace App\Models\Queries;

use App\Models\Queries\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
