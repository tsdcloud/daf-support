<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FonctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fonctions')->insert([
            [
                'fonction' => 'IT Developper',
                'user_entity_id' => 1,
                'department_id' => 1,
                'category_id' => 9,
                'echelon_id' => 2,
            ],
            

        ]);
    }
}
