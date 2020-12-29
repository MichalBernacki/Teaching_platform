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
            'name' => 'Programowanie Obiektowe II',
            'lecturer_id' => '1',
            'description' => 'Kontynuacja kursu Programowanie Obiektowe I'
        ]);
    }
}
