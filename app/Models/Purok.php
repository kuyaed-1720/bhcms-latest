<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purok extends Model
{
    protected $fillable = ['purok_name'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
