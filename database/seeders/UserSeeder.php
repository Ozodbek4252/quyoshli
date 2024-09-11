<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::create([
//            'first_name' => 'ulasoft',
//            'last_name' => 'ulasoft',
//            'password' => 'qwerty56',
//            'role_id' => 1,
//            'phone' => '998913333111',
//        ]);
//
//        User::create([
//            'first_name' => 'admin',
//            'last_name' => 'Adminovich',
//            'password' => 'qwerty56',
//            'role_id' => 1,
//            'phone' => '998971234567',
//        ]);
        User::create([
            'first_name' => 'Jasurbek',
            'last_name' => 'Abdurakhmonov',
            'password' => 'qwerty56',
            'role_id' => 1,
            'phone' => '998998973290',
        ]);
    }
}
