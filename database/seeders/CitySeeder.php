<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'id' => 1,
            'country_id' => 1,
            'label' => 'Yaoundé',
        ]);
        City::create([
            'id' => 2,
            'country_id' => 1,
            'label' => 'Douala',
        ]);
    }
}
