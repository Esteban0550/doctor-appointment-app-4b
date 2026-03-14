<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionItem extends Model
{
    protected $fillable = [
        'consultation_id',
        'medicine_name',
        'dose',
        'frequency',
    ];

    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }
}
