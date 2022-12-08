<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function consultationReview(): HasOne
    {
        return $this->hasOne(ConsultationReview::class);
    }

    public function consultationRequest(): HasOne
    {
        return $this->hasOne(ConsultationRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function children(): BelongsTo
    {
        return $this->belongsTo(Children::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
