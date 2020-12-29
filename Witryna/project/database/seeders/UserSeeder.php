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
            'name' => 'Adam Malysz',
            'email' => 'jdd.dodde@gmail.com',
            'password' => bcrypt('secret123'),
            'role_id' => 2
        ]);

        DB::table('users')->insert([
            'name' => 'Krzysztof Kononowicz',
            'email' => 'k.k@wp.pl',
            'password' => bcrypt('secret33'),
            'role_id' => 3
        ]);

        DB::table('users')->insert([
            'name' => 'Robert Kubica',
            'email' => 'roku@gmail.com',
            'password' => bcrypt('secretddd'),
            'role_id' => 4
        ]);
    }
}
