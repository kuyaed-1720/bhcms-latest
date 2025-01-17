<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'start_term',
        'end_term',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
