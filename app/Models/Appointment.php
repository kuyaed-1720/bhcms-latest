<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'health_worker_id',
        'title',
        'description',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class)->with('user');
    }
    
    public function healthWorker()
    {
        return $this->belongsTo(HealthWorker::class)->with('user');
    }

    /**
     * Scope a query to include appointments between two dates.
     */
    public function scopeBetween(Builder $query, $start, $end)
    {
        return $query->whereBetween('appointment_date', [$start, $end]);
    }
}
