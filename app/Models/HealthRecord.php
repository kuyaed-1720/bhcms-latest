<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    protected $fillable = [
        'user_id',
        'ph_member',
        'philhealth_no',
        'height',
        'weight',
        'bmi',
        'waist_circumference',
        'with_hpn',
        'with_dm',
        'pregnant',
        'lmp',
        'pregnancy_test',
        'gp',
        'smoking',
        'alcohol_intake',
        'had_five_drinks',
        'chief_complaint',
        'diagnosis',
        'management',
        'record_date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function patient()
    // {
    //     return $this->belongsTo(User::class, 'patient_id');
    // }

    // public function healthWorker()
    // {
    //     return $this->belongsTo(User::class, 'health_worker_id');
    // }
}
