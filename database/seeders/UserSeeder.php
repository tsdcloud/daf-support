<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'fname'=>'Admin',
                'lname'=>'ADMIN ADMIN',
                'phone'=>'699999999',
                'email'=>'tsd@bfclimited.com',
                'password'=>Hash::make('tsd@bfclimited.com'),
            ],

        ]);
    }
}
