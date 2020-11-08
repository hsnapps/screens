<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $fillable = [
        'id',
        'content_start',
        'content_end',
        'fingerprint',
        'user_id',
    ];

    protected $dates = [
        'content_start',
        'content_end',
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
