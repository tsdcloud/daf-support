<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facade\DB;

class ValidationFicheDepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('validation_fiche_depenses')->insert([
            [
                'user_id' => 2,
                'validateur' => 'ordonateur',
                'entity_id' => 1,
            ],
            [
                'user_id' => 2,
                'validateur' => 'controlleur',
                'entity_id' => 1,
            ],
        ]);
    }
}
