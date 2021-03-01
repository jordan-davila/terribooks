<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run()
    {
        Publisher::factory()->create(["team_id" => 1, "name" => "John Mendez"]);
        Publisher::factory()->create(["team_id" => 1, "name" => "Cristian Ruiz"]);
        Publisher::factory()->create(["team_id" => 1, "name" => "Austin Segarra"]);
        Publisher::factory()->create(["team_id" => 1, "name" => "Tony Rudolph"]);
        Publisher::factory()->create(["team_id" => 1, "name" => "Armando Perez"]);
        Publisher::factory()->create(["team_id" => 1, "name" => "Julio Ormaza"]);
        Publisher::factory()->create(["team_id" => 1, "name" => "Jerry Espinoza"]);
        Publisher::factory()->create(["team_id" => 1, "name" => "Rondald Ruiz"]);
    }
}
