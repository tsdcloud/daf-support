<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EchelonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('echelons')->insert([
            [
                'title' => 'A',
            ],
            [
                'title' => 'B',
            ],
            [
                'title' => 'C',
            ],
            [
                'title' => 'D',
            ],
            [
                'title' => 'E',
            ],
            [
                'title' => 'F',
            ],
        ]);
    }
}
