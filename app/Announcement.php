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
        'user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'begin' => 'datetime:Y-m-d',
        'end' => 'datetime:Y-m-d',
    ];

    protected $dates = [
        'begin',
        'end',
    ];

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
