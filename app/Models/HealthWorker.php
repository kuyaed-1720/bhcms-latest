<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthWorker extends Model
{
    protected $fillable = [
        'start_term',
        'end_term'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'health_worker_id');
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'health_worker_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->user->first_name} {$this->user->last_name} {$this->user->extension_name}";
    }
}

