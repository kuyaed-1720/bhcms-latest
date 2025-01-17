<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'health_worker_id',
        'medications',
        'prescriptions',
        'diagnosis',
        'notes',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function healthWorker()
    {
        return $this->belongsTo(User::class, 'health_worker_id');
    }
}
