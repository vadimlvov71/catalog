<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'testuser',
            'email' => 'testuser@example.com', // if you have an email column
            'password' => Hash::make('secret123'), // always hash the password!
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}