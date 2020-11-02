<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'screen_id',
        'type',
        'value',
        'begin',
        'end',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'begin',
        'end',
    ];
}
