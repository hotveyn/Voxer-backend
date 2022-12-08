<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function consultants()
    {
        return $this->hasMany(User::class);
    }
}
