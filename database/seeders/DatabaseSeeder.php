<?php

namespace Database\Seeders;


use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::factory(10)->has(
        //     Course::factory(5)->hasLessons(10)
        // )->create();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('pass1234'),
            'is_admin' => 'super_admin',
            'subscribed' => 1,
        ]);



    }
}
