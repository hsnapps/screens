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
            'is_admin' => true,
            'section' => null,
            'remember_token' => null,
        ]);
    }
}
