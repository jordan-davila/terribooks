<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        City::create([
            "id" => 1,
            "team_id" => 1,
            "name" => "East Orange",
            "order" => null,
            "created_at" => "2020-06-08 22:51:59",
            "updated_at" => "2020-06-08 22:51:59",
        ]);

        City::create([
            "id" => 2,
            "team_id" => 1,
            "name" => "Bloomfield",
            "order" => null,
            "created_at" => "2020-06-08 22:51:59",
            "updated_at" => "2020-06-08 22:51:59",
        ]);

        City::create([
            "id" => 3,
            "team_id" => 1,
            "name" => "Newark",
            "order" => null,
            "created_at" => "2020-06-08 22:51:59",
            "updated_at" => "2020-06-08 22:51:59",
        ]);

        City::create([
            "id" => 4,
            "team_id" => 2,
            "name" => "Newark",
            "order" => null,
            "created_at" => "2020-07-07 09:31:40",
            "updated_at" => "2020-07-07 09:31:40",
        ]);

        City::create([
            "id" => 6,
            "team_id" => 3,
            "name" => "Sample City",
            "order" => null,
            "created_at" => "2020-07-07 09:31:40",
            "updated_at" => "2020-07-07 09:31:40",
        ]);

        City::create([
            "id" => 7,
            "team_id" => 4,
            "name" => "Sample City",
            "order" => 1,
            "created_at" => "2020-09-20 17:56:40",
            "updated_at" => "2020-09-20 17:56:40",
        ]);
    }
}
