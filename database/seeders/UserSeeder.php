<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'admin@mail.com',
            'nama' => 'administrator',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'last_login' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
