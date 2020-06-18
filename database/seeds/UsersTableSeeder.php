<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Seed database with nessery users
     * Change email of this users in order to recive mail notification
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(['role' => 'moderator', 'email' => 'moderator@app.com', 'password' => Hash::make('password')]);
        factory(App\User::class)->create(['role' => 'manager', 'email' => 'manager@app.com', 'password' => Hash::make('password')]);
    }
}
