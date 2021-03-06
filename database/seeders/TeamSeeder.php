<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        Team::factory()->create([
            "id" => 1,
            "name" => "West Newark",
            "user_id" => 1,
            "personal_team" => false,
        ]);

        Team::create([
            "id" => 2,
            "name" => "East Newark",
            "user_id" => 3,
            "personal_team" => false,
            "created_at" => "2020-06-28 16:50:50",
            "updated_at" => "2020-06-28 16:50:50",
        ]);

        Team::create([
            "id" => 3,
            "name" => "Splendora ISD",
            "user_id" => 4,
            "personal_team" => false,
            "created_at" => "2020-07-07 09:31:40",
            "updated_at" => "2020-07-07 09:31:40",
        ]);

        Team::create([
            "id" => 4,
            "name" => "Test",
            "user_id" => 5,
            "personal_team" => false,
            "created_at" => "2020-09-20 17:56:40",
            "updated_at" => "2020-09-20 17:56:40",
        ]);
    }
}
