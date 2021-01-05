<?php

namespace Database\Seeders;

use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(CourseUserSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(LessonTimeSeeder::class);
        $this->call(LessonTimeUserSeeder::class);
    }
}
