<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'birthday',
        'age',
        'phone_number',
        // 'province',
        // 'city',
        // 'barangay',
        'purok_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role_id' => 'integer',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // A user can have many appointments as a patient
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    // A user can also be a health worker with many appointments
    public function healthWorkerAppointments()
    {
        return $this->hasMany(Appointment::class, 'health_worker_id');
    }

    // A user has a role (admin, healthworker, patient, etc.)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // A user has a specific 'purok' (subdivision or neighborhood)
    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }

    // A user may be a patient (through Patient model)
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    // A user may be a health worker (through HealthWorker model)
    public function healthWorker()
    {
        return $this->hasOne(HealthWorker::class);
    }
    
    public function isAdmin()
    {
        return $this->role_id === 1;
    }
    
    public function isHealthWorker()
    {
        return $this->role_id === 2;
    }
    
    public function isPatient()
    {
        return $this->role_id === 3;
    }
}
