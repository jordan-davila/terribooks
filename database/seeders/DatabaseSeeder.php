<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// prettier-ignore
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
            TeamSeeder::class,
            PublisherSeeder::class,
            AssignmentSeeder::class,
        ]);
    }
}
