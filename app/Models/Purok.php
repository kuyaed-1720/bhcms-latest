<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purok extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
