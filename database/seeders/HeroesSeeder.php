<?php

namespace Database\Seeders;

use App\Models\Heroe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class HeroesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Heroe::create([
            'name'=> 'Takaro',
            'description' => 'Loweno dura poco',
            'hasCape' => false
        ]);
        Heroe::create([
            'name'=> 'Takaro',
            'description' => 'Loweno dura poco',
            'hasCape' => false
        ]);
    }
}
