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
            'user_id' => 1,
            'course_id'=>1,
            'confirmed'=>true
        ]);
        DB::table('course_user')->insert([
            'user_id' => 2,
            'course_id'=>1,
            'confirmed'=>false
        ]);
        DB::table('course_user')->insert([
            'user_id' => 2,
            'course_id'=>2,
            'confirmed'=>false
        ]);
    }
}
