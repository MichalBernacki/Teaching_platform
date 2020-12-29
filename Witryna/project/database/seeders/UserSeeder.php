<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('secret'),
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => 'Johan Wu',
            'email' => 'johan.wu@gmail.com',
            'password' => bcrypt('verySecret'),
            'role_id' => 3
        ]);
    }
}
