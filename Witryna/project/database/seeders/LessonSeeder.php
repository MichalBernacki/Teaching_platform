<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->insert([
            'id' => 1,
            'title' => 'korelacja',
            'course_id' => 1,
            'description' => 'xcorr'
        ]);
        DB::table('lessons')->insert([
            'id' => 2,
            'title' => 'splot',
            'course_id' => 1,
            'description' => 'conv'
        ]);
    }
}
