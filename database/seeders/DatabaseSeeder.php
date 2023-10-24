<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(SiteSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CityEntitySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EchelonSeeder::class);
        $this->call(EntitySeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UserEntitySeeder::class);
        $this->call(FonctionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PrivilegeSeeder::class);
    }
}
