<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the doctors for this specialty.
     */
    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class, 'speciality_id');
    }
}
