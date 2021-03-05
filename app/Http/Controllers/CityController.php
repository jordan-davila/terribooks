<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Team;
use App\Models\Territory;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function store(Team $team, Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
        ]);

        $city = $team->cities()->create([
            "team_id" => $team->id,
            "name" => $request["name"],
        ]);

        $territory = $city->territories()->create([
            "city_id" => $city->id,
            "order" => 1,
        ]);

        $types = ["field", "phone", "business"];
        foreach ($types as $type) {
            $territory->assignments()->create([
                "team_id" => $team->id,
                "territory_id" => $territory->id,
                "date_out" => null,
                "date_in" => null,
                "current" => true,
                "type" => $type,
            ]);
        }

        return back(303);
    }

    public function update(Team $team, City $city, Request $request)
    {
        $request->validate(["name" => "required|min:3"]);
        $city->name = $request["name"];
        $city->save();
        return back(303);
    }

    public function destroy(Team $team, City $city)
    {
        $city->delete();
        return back(303);
    }
}
