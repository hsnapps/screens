<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $fillable = [
        'content_start',
        'content_end',
        'snapshot',
    ];

    protected $dates = [
        'content_start',
        'content_end',
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
