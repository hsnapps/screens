<?php

use App\Screen;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 40; $i++) {
            Screen::create([
                'id' => $i + 1,
            ]);
        }

        User::create([
            'name' => 'مشرف النظام',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => null,
        ]);
    }
}
