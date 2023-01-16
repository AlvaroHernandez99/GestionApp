<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanycarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companycars')->insert([
            'matricula'=> '113456x',
            'marca' => 'renault',
            'modelo' => 'laguna'
        ]);
        DB::table('companycars')->insert([
            'matricula'=> '123426x',
            'marca' => 'renault',
            'modelo' => 'berlingo'
        ]);
        DB::table('companycars')->insert([
            'matricula'=> '123456x',
            'marca' => 'renault',
            'modelo' => 'zafira'
        ]);
    }
}
