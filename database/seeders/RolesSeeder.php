<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'rol'=> 'administrador',
            'description'=> 'controlar el sistema'

        ]);
        DB::table('roles')->insert([
            'rol'=> 'usuario',
            'description'=> 'trabajar con el sistema'
        ]);
        DB::table('roles')->insert([
            'rol'=> 'testeador',
            'description'=> 'testea el sistema'
        ]);
    }
}
