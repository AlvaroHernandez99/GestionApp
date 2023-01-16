<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'name'=> 'Juan',
            'phone' => '666666666',
            'age' => 23,
            'password' => 'contraseña1',
            'email' => 'juan@gmail.com',
            'gender' => 'sexo',
            'role_id' => 1
        ]);
        DB::table('employees')->insert([
            'name'=> 'perico',
            'phone' => '666666666',
            'age' => 23,
            'password' => 'contraseña1',
            'email' => 'perico@gmail.com',
            'gender' => 'sexo',
            'role_id' => 2
        ]);
    }
}
