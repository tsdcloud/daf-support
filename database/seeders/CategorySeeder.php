<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => 'Categorie 1'
            ],
            [
                'title' => 'Categorie 2'
            ],
            [
                'title' => 'Categorie 3'
            ],
            [
                'title' => 'Categorie 4'
            ],
            [
                'title' => 'Categorie 5'
            ],
            [
                'title' => 'Categorie 6'
            ],
            [
                'title' => 'Categorie 7'
            ],
            [
                'title' => 'Categorie 8'
            ],
            [
                'title' => 'Categorie 9'
            ],
            [
                'title' => 'Categorie 10'
            ],
            [
                'title' => 'Categorie 11'
            ],
            [
                'title' => 'Categorie 12'
            ],
        ]);
    }
}
