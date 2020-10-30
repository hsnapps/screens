<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timing extends Model
{
    protected $fillable = [
        'lecture',
        'morning',
        'start',
        'end',
    ];

    protected $casts = [
        'morning' => 'boolean',
    ];
}
