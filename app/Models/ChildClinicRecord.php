<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildClinicRecord extends Model
{
    protected $fillable = [
        'child_id',
        'epi_status',
        'bcg',
        'dpt',
        'opv',
        'hepa_b',
        'am',
        'type_of_feeding',
        'wt',
        'vs',
        'chief_complaint',
        'other_cc',
        'management',
        'record_date'
    ];
}
