<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaternalRecord extends Model
{
    protected $fillable = [
        'user_id',
        'husband_name',
        'tt_status',
        'gp',
        'lmp',
        'edc',
        'termination_of_pregnancy',
        'outcome',
        'date_1',
        'date_2',
        'date_3',
        'ob_findings',
        'risk_code',
        'tt_given',
        'management'
    ];
}
