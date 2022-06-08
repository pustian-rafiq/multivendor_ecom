<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            // Admin
            [
                'full_name' => 'Md. Rafiqul Islam',
                'username' => 'Rafiq',
                'email' => 'rafiqul.pust.cse@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'status' => 'active',
            ],
            // vendor
            [
                'full_name' => 'Md. Vendor',
                'username' => 'Vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'vendor',
                'status' => 'active',
            ],
            // Customer
            [
                'full_name' => 'Md. Customer',
                'username' => 'Customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 'customer',
                'status' => 'active',
            ],
        ]);
    }
}
