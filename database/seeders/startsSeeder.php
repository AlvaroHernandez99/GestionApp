<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class startsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::create('_starts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 34);
            $table->string('description', 300)->nullable();
            $table->boolean('hasCape');
            $table->timestamps();
        });
    }
}
