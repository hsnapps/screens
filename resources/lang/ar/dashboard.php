<?php

return [
    0 => [
        'users',
        'إدارة المستخدمين',
        route('users.index'),
    ],
    1 => [
        'clock',
        'توقيت المحاضرات',
        route('timing.get'),
    ],
    2 => [
        'calendar',
        'الجداول',
        route('schedules.index'),
    ],
    3 => [
        'thumbnails',
        'الشاشات',
        route('screens.index'),
    ],
    4 => [
        'user',
        'المحاضرين',
        route('instructors.index'),
    ],
    5 => [
        'info',
        'حول البرنامج',
        route('about'),
    ],
];
