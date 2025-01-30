<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'purpose',
        'appointment_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function patient()
    // {
    //     return $this->belongsTo(Patient::class)->with('user');
    // }
    
    // public function healthWorker()
    // {
    //     return $this->belongsTo(HealthWorker::class)->with('user');
    // }

    /**
     * Scope a query to include appointments between two dates.
     */
    public function scopeBetween(Builder $query, $start, $end)
    {
        return $query->whereBetween('appointment_date', [$start, $end]);
    }
}
