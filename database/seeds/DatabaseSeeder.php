<?php

use App\{
    Screen,
    User,
    Timing
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($h=0; $h < 40; $h++) {
            Screen::create([
                'fingerprint' => Str::random(80),
            ]);
        }

        User::create([
            'name' => 'مشرف النظام',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => null,
        ]);

        for ($h=0; $h < 7; $h++) {
            Timing::create([
                'lecture' => $h + 1,
                'morning' => true,
                'start' => sprintf('%02d:00', $h + 7),
                'end' => sprintf('%02d:00', $h + 8),
            ]);
        }

        for ($h=0; $h < 7; $h++) {
            Timing::create([
                'lecture' => $h + 1,
                'morning' => false,
                'start' => sprintf('%02d:00', $h + 14),
                'end' => sprintf('%02d:00', $h + 15),
            ]);
        }
    }
}
