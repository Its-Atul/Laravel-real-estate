<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role'=> 'admin',
                'photo' => fake()->imageURL('60', '60'),
                'phone' => fake()->phoneNumber,
                'address' => fake()->address,
                'status' => 'active',
                'remember_token' => Str::random(10),
            ],


                 //Agent
            [
                'name' => 'Agent',
                'username' => 'agent',
                'email' => 'agent@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role'=> 'agent',
                'photo' => fake()->imageURL('60', '60'),
                'phone' => fake()->phoneNumber,
                'address' => fake()->address,
                'status' => 'active',
                'remember_token' => Str::random(10),
            ],
                   //User
            [
                    'name' => 'User',
                    'username' => 'user',
                    'email' => 'user@gmail.com',
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'),
                    'role'=> 'user',
                    'photo' => fake()->imageURL('60', '60'),
                    'phone' => fake()->phoneNumber,
                    'address' => fake()->address,
                    'status' => 'active',
                    'remember_token' => Str::random(10),
            ],


        ]);
    }
}
