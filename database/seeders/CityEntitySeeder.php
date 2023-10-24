<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CityEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 c'est BFC
        DB::table('city_entity')->insert([
            'entity_id' => 1,
            'city_id' => 1  //Yaoundé
        ]);
        DB::table('city_entity')->insert([
            'entity_id' => 1,
            'city_id' => 2 //Douala
        ]);
        // 2  C'est DPWS
        // DB::table('city_entity')->insert([
        //     'entity_id' => 2,
        //     'city_id' => 2 //Douala
        // ]);
    }
}
