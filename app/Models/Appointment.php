<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'reason',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function consultation(): HasOne
    {
        return $this->hasOne(Consultation::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ((int) $this->status) {
            1       => 'Programado',
            2       => 'Completado',
            3       => 'Cancelado',
            default => 'Desconocido',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ((int) $this->status) {
            1       => 'blue',
            2       => 'green',
            3       => 'red',
            default => 'gray',
        };
    }
}
