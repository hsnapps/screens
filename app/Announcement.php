<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'screen_id',
        'type',
        'value',
        'html',
    ];
}
