<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'id' => 1,
            'name' => 'TS',
            'lecturer_id' => 2,
            'description' => 'Teoria Sygnalow'
        ]);

        DB::table('courses')->insert([
            'id' => 2,
            'name' => 'Course',
            'lecturer_id' => 5,
            'description' => 'Course course'
        ]);
        DB::table('courses')->insert([
            'id' => 3,
            'name' => 'FIZ',
            'lecturer_id' => 2,
            'description' => 'Fizyka II'
        ]);
        DB::table('courses')->insert([
            'id' => 4,
            'name' => 'Programowanie Obiektowe',
            'lecturer_id' => 5,
            'description' => 'PO'
        ]);
    }
}
