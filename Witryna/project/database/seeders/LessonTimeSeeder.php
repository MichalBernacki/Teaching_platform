<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson_times')->insert([
            'id' => 1,
            'lesson_id' => '1',
            'time' => '074500',
            'date' => '20210111'
        ]);
        DB::table('lesson_times')->insert([
            'id' => 2,
            'lesson_id' => '1',
            'time' => '093000',
            'date' => '20210111'
        ]);
        DB::table('lesson_times')->insert([
            'id' => 3,
            'lesson_id' => '2',
            'time' => '121500',
            'date' => '20210112'
        ]);
    }
}
