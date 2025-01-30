<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImmunizationRecord extends Model
{
    protected $fillable = [
        'child_id',
        'health_center',
        'barangay',
        'family_no',
        'vaccine_name',
        'vaccine_date',
        'dosage',
        'dose_no',
        'remarks',
    ];
}
