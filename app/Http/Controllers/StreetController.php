<?php

namespace App\Http\Controllers;

use App\Models\Street;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

class StreetController extends Controller
{
    protected $abrs = [
        "North" => "N",
        "South" => "S",
        "West" => "W",
        "East" => "E",
        "Street" => "St",
        "Avenue" => "Ave",
        "Parkway" => "Pky",
        "Boulevard" => "Blvd",
    ];

    public function fixName($name)
    {
        $request = str_replace([",", "."], "", $name);
        $explode = explode(" ", $request);
        $last_index = count($explode) - 1;
        $long = $explode[$last_index];
        $abr = isset($this->abrs[$long]) ? $this->abrs[$long] : $long;
        $explode[$last_index] = $abr;
        return implode(" ", $explode);
    }

    public function store(Territory $territory, Request $request)
    {
        $validator = $request->validate([
            "name" => "required|unique:cities|min:3",
        ]);

        $last_street = $territory
            ->streets()
            ->orderBy("order")
            ->get()
            ->last();

        $street = $territory->streets()->create([
            "territory_id" => $territory->id,
            "name" => $this->fixName($request["name"]),
            "order" => $last_street ? $last_street->order + 1 : 1,
        ]);

        return back(303);
    }

    public function update(Territory $territory, Street $street, Request $request)
    {
        $validator = $request->validate([
            "name" => "required|unique:cities|min:3",
        ]);

        $street->name = $this->fixName($request["name"]);
        $street->order = $request["order"];
        $street->save();
        return back(303);
    }

    public function destroy(Territory $territory, Street $street)
    {
        $street->delete();
        $params = previousRoute()->originalParameters();
        $params["street"] = $street->territory->streets->first()->id;
        return Redirect::route(previousRoute()->getName(), $params);
    }
}
