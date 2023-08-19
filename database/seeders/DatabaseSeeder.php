<?php

namespace Database\Seeders;


use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
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

        User::factory(10)->has(
            Course::factory(5)->hasLessons(10)
        )->create();

    }
}
