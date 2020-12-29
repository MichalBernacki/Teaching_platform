<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'None',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'Student',
        ]);

        DB::table('roles')->insert([
            'id' => 3,
            'name' => 'Lecturer',
        ]);

        DB::table('roles')->insert([
            'id' => 4,
            'name' => "Dean's office employee",
        ]);
    }
}
