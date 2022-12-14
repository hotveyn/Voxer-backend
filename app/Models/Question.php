<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function questionCategory(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class);
    }
}
