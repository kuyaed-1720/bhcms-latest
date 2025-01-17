<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'weight',
        'height',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class, 'patient_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->user->first_name} {$this->user->last_name} {$this->user->extension_name}";
    }
}
