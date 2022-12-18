<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name'=> 'alvaro',
            'phone' => '666666666',
            'age' => 23,
            'password' => 'contraseña1',
            'email' => 'alvaro@gmail.com',
            'gender' => 'sexo'
        ]);
        DB::table('customers')->insert([
            'name'=> 'pedro',
            'phone' => '666666666',
            'age' => 23,
            'password' => 'contraseña1',
            'email' => 'pedro@gmail.com',
            'gender' => 'sexo'
        ]);
        DB::table('customers')->insert([
            'name'=> 'juan',
            'phone' => '666666666',
            'age' => 23,
            'password' => 'contraseña1',
            'email' => 'juan@gmail.com',
            'gender' => 'sexo'
        ]);

        DB::table('customers')->insert([
            'name'=> 'pepe',
            'password' => 'contraseña1',
            'email' => 'pepe@gmail.com',
            'gender' => 'sexo'
        ]);
    }
}
