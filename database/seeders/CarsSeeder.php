<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            'matricula'=> '113456x',
            'marca' => 'renault',
            'modelo' => 'laguna',
            'employee_id' => 1
        ]);
        /*DB::table('companycars')->insert([
            'matricula'=> '123426x',
            'marca' => 'renault',
            'modelo' => 'berlingo',
            'employee_id' => 2
        ]);
        DB::table('companycars')->insert([
            'matricula'=> '123456x',
            'marca' => 'renault',
            'modelo' => 'zafira',
            'employee_id' => 3
        ]);*/
    }
}
