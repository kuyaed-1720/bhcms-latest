<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $fillable = [
        'parent_id',
        'mother',
        'father',
        'birthdate',
        'birthplace',
        'age',
        'sex',
        'birth_height',
        'birth_weight,'
        'address',
    ];
}
