<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultaionRequest extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function consultaion(): BelongsTo
    {
        return $this->belongsTo(Consultaion::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
