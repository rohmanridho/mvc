<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123qweasd'),
            'level' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Staff 1',
            'email' => 'staff1@gmail.com',
            'password' => Hash::make('123qweasd'),
            'level' => 'staff',
        ]);
        DB::table('users')->insert([
            'name' => 'Staff 2',
            'email' => 'staff2@gmail.com',
            'password' => Hash::make('123qweasd'),
            'level' => 'staff',
        ]);

        DB::table('users')->insert([
            'name' => 'Public 1',
            'email' => 'public1@gmail.com',
            'password' => Hash::make('123qweasd'),
            'level' => 'public',
        ]);
        DB::table('users')->insert([
            'name' => 'Public 2',
            'email' => 'public2@gmail.com',
            'password' => Hash::make('123qweasd'),
            'level' => 'public',
        ]);
        DB::table('users')->insert([
            'name' => 'Public 3',
            'email' => 'public3@gmail.com',
            'password' => Hash::make('123qweasd'),
            'level' => 'public',
        ]);
    }
}