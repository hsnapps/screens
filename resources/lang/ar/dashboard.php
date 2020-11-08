<?php

use Illuminate\Support\Facades\Auth;

return [
    0 => [
        'users',
        'إدارة المستخدمين',
        Auth::user()->is_admin ? route('users.index') : route('dashboard'),
    ],
    1 => [
        'user',
        'المدرسين',
        route('instructors.index'),
    ],
    2 => [
        'calendar',
        'الجداول',
        Auth::user()->is_admin ? route('schedules.index') : route('dashboard'),
    ],
    3 => [
        'thumbnails',
        'الشاشات',
        route('screens.index'),
    ],
    4 => [
        'ignore',
        '',
        '#',
    ],
    5 => [
        'info',
        'حول البرنامج',
        route('about'),
    ],
];
