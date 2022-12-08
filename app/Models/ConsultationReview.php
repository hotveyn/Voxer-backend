<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ConsultationReview extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }
}
