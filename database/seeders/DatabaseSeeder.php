<?php

namespace Database\Seeders;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        \App\Models\User::factory()->create([
            'name' => 'william victor',
            'email' => 'vicken408@gmail.com',
            'email_verified_at' => now(),
            'is_admin' => 1,
            'password' => bcrypt('pass111'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}
