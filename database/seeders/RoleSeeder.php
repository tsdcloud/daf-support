<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'title' => 'Comptable',
            ],
            [
                'title' => 'Ordonnateur',
            ],
            [
                'title' => 'Contrôleur budgétaire',
            ],
            [
                'title' => 'Contrôleur conformité',
            ],
            [
                'title' => 'Administrateur',
            ],
            [
                'title' => 'Caissier',
            ],
            [
                'title' => 'Chef département',
            ],
            [
                'title' => 'Contrôleur recette',
            ],
            [
                'title' => 'Coordonnateur',
            ],
            // [
            //     'title' => 'Chef de guérite',
            // ],
            [
                'title' => 'Comptable matière',
            ],


            // [
            //     'title' => 'Directeur général',
            // ],
            // [
            //     'title' => 'Président',
            // ],
        ]);
    }
}
