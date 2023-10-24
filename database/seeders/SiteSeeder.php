<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'label'=>'Bonapriso',
            'city_id'=>2,
            'entity_id'=>2,
        ]);

        Site::create([
            'label'=>'Bonapriso',
            'city_id'=>2,
            'entity_id'=>1,
        ]);

        Site::create([
            'label'=>'Bastos',
            'city_id'=>1,
            'entity_id'=>1,
        ]);

        Site::create([
            'label'=>'Nkometou',
            'city_id'=>1,
            'entity_id'=>1,
        ]);
    }
}
