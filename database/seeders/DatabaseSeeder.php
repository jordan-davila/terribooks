<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CitySeeder::class,
            TerritorySeeder::class,
            StreetSeeder::class,
            HouseSeeder::class,
            ApartmentSeeder::class,
            PhoneSeeder::class,
            BusinessSeeder::class,
            UserSeeder::class,
        ]);
    }
}
