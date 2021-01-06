<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course_user')->insert([
            'course_id' => 2,
            'user_id' => 4,
            'confirmed' =>true,
            'mark' => 0
        ]);

        DB::table('course_user')->insert([
            'course_id' => 2,
            'user_id' => 1,
            'confirmed' =>true,
            'mark' => 0
        ]);

        DB::table('course_user')->insert([
            'user_id' => 1,
            'course_id'=>1,
            'confirmed'=>true,
            'mark' => 0
        ]);
    }
}
