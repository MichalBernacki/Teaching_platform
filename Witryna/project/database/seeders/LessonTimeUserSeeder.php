<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LessonTimeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson_time_user')->insert([
            'id' => 1,
            'lesson_time_id' => 1,
            'user_id' => 1,
            'presence' => 1,
            'pluses' =>4
        ]);
        DB::table('lesson_time_user')->insert([
            'id' => 2,
            'lesson_time_id' => 2,
            'user_id' => 1,
            'presence' => 1,
            'pluses' =>2
        ]);
        DB::table('lesson_time_user')->insert([
            'id' => 3,
            'lesson_time_id' => 3,
            'user_id' => 1,
            'presence' => 0,
            'pluses' => 0
        ]);
        DB::table('lesson_time_user')->insert([
            'id' => 4,
            'lesson_time_id' => 1,
            'user_id' => 4,
            'presence' => 1,
            'pluses' =>7
        ]);
        DB::table('lesson_time_user')->insert([
            'id' => 5,
            'lesson_time_id' => 3,
            'user_id' => 4,
            'presence' => 1,
            'pluses' =>1
        ]);
    }
}
