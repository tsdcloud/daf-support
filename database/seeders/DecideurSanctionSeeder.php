<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DecideurSanctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('decideur_sanctions')->insert([
            [
                'user_id' => 1,
                'decision_sur' => 'demande_explication'
            ],
        ]);
    }
}
