<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grades')->insert([
            [
                'title'=>'Junior Executive Assistant',
            ],
            [
                'title'=>'Executive Assistant',
            ],
            [
                'title'=>'Senior Executive Assistant',
            ],
            [
                'title'=>'Junior Manager',
            ],
            [
                'title'=>'Manager',
            ],
            [
                'title'=>'Senior Manager',
            ],
            [
                'title'=>'Junior Executive Director',
            ],
            [
                'title'=>'Executive Director',
            ],
            [
                'title'=>'Senior Executive Director',
            ],
            [
                'title'=>'Junior CEO',
            ],
            [
                'title'=>'CEO',
            ],
            [
                'title'=>'Senior CEO',
            ],
        ]);
    }
}
