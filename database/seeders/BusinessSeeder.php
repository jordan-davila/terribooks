<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    public function run()
    {
        Business::create([
            "id" => 1,
            "street_id" => 884,
            "number" => "151",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        Business::create([
            "id" => 2,
            "street_id" => 705,
            "number" => "64",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        Business::create([
            "id" => 3,
            "street_id" => 505,
            "number" => "397",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        Business::create([
            "id" => 4,
            "street_id" => 586,
            "number" => "589",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        Business::create([
            "id" => 5,
            "street_id" => 465,
            "number" => "468",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        Business::create([
            "id" => 6,
            "street_id" => 331,
            "number" => "315",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "No Visitar",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        Business::create([
            "id" => 7,
            "street_id" => 331,
            "number" => "321",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);

        Business::create([
            "id" => 8,
            "street_id" => 331,
            "number" => "325",
            "symbol" => "NC",
            "color" => "none",
            "name" => null,
            "phone" => null,
            "observations" => "",
            "created_at" => "2020-06-08 22:52:22",
            "updated_at" => "2020-06-08 22:52:22",
        ]);
    }
}
