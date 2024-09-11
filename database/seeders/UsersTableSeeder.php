<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'ulasoft',
            'last_name' => 'ulasoft',
            'password' => 'qwerty56',
            'role_id' => 1,
            'phone' => '998913333111',
        ])->roles()->attach([1]);

        User::create([
            'first_name' => 'admin',
            'last_name' => 'Adminovich',
            'password' => 'qwerty56',
            'role_id' => 1,
            'phone' => '998971234567',
        ])->roles()->attach([3, 4]);
    }
}
