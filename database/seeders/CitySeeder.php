<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        City::create([
            'team_id' => 1,
            'name' => "East Orange",
        ]);

        City::create([
            'team_id' => 1,
            'name' => 'Bloomfield',
        ]);

        City::create([
            'team_id' => 1,
            'name' => 'Newark',
        ]);
    }
}
