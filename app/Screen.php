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

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
