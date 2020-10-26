<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'id',
        'html',
    ];
}
