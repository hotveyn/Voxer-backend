<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Consultaion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function consultaionReview(): HasOne
    {
        return $this->hasOne(ConsultaionReview::class);
    }

    public function consultaionRequest(): HasOne
    {
        return $this->hasOne(ConsultaionRequest::class);
    }

    public function consultant()
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
