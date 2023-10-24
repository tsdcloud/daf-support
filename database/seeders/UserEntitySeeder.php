<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_entities')->insert([
            [
                'user_id' => 1,
                'grade_id' => 5,
                'entity_id' => 1,
            ],
            

        ]);
    }
}
