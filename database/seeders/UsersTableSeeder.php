<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     // Insert multiple users data
    //     DB::table('users')->insert([
    //         [
    //             'user_id' => 1,
    //             'name' => 'vinay jaiswal',
    //             'email' => 'vinay.jaiswal@velocis.co.in',
    //             'password' => Hash::make('Vinay@9967'),  // Securely hash the password
    //             'email_verified_at' => now()
    //         ],
    //         [
    //             'user_id' => 2,
    //             'name' => 'sssder',
    //             'email' => 'sssder@example.com',
    //             'password' => Hash::make('password123'),  // Securely hash the password
    //             'email_verified_at' => now()
    //         ],
    //         // Add more users if needed
    //     ]);
    // }
}
