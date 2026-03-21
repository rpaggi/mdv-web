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
        if (app()->environment('production')) {
            return;
        }

        $this->call([
            \Guiliredu\BrazilianCityMigrationSeed\Database\Seeds\DatabaseSeeder::class,
            CreateRoles::class,
            CreateMaster::class,
            CreateBaseSeeder::class,
        ]);
    }
}
