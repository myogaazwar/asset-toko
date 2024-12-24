<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        DB::table('users')->insert([
            'nik' => '19200044',
            'name' => 'Agus',
            'password' => bcrypt('password'),
            'role' => 'ADMIN',
        ]);

        DB::table('users')->insert([
            'nik' => '19200022',
            'name' => 'Muhammad Yoga Azwar',
            'password' => bcrypt('password'),
            'role' => 'USER',
        ]);

        DB::table('users')->insert([
            'nik' => '19200055',
            'name' => 'Ilham',
            'password' => bcrypt('password'),
            'role' => 'MANAGER',
        ]);
    }
}
