<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(['role' => 'moderator', 'email' => 'moderator@gmail.com', 'password' => Hash::make('password')]);
        factory(App\User::class)->create(['role' => 'manager', 'email' => 'manager@gmail.com', 'password' => Hash::make('password')]);
    }
}
