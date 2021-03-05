<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Team;
use Inertia\Inertia;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TerritoryResource;

class TerritoryController extends Controller
{
    public function index()
    {
        $team = Auth()->user()->currentTeam;
        $territory = !is_null($team) ? $team->territories->first() : null;

        if (!is_null($team)) {
            return !is_null($territory) ? Redirect::route("territories.show", ["territory" => $territory]) : Inertia::render("Territories/Overview/NoCities");
        } else {
            return Inertia::render("Territories/Overview/NoCongregations");
        }
    }

    public function show(Territory $territory)
    {
        return Inertia::render("Territories/Overview/Show", [
            "territory" => new TerritoryResource($territory),
        ]);
    }

    public function map(Territory $territory)
    {
        return Inertia::render("Territories/Map/Show", [
            "territory" => new TerritoryResource($territory),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(["number" => "required"]);
        $territory = Territory::create([
            "city_id" => $request["city_id"],
            "order" => $request["number"],
        ]);

        $types = ["field", "phone", "business"];
        foreach ($types as $type) {
            $territory->assignments()->create([
                "team_id" => Auth()->user()->currentTeam->id,
                "territory_id" => $territory->id,
                "date_out" => null,
                "date_in" => null,
                "current" => true,
                "type" => $type,
            ]);
        }
        return back(303);
    }

    public function update(Territory $territory, Request $request)
    {
        $request->validate(["number" => "required"]);
        $territory->city_id = $request["city_id"];
        $territory->order = $request["number"];
        $territory->save();
        return back(303);
    }

    public function updateCoordinates(Territory $territory, Request $request)
    {
        $territory->coordinates = $request["coordinates"];
        $territory->save();
        return back(303);
    }

    public function destroy(Territory $territory)
    {
        $city = City::find($territory->city_id);
        $territory->delete();

        if ($city->territories->count() == 0) {
            $this->store(new Request(["city_id" => $city->id, "number" => 1]));
        }

        return Redirect::route(
            "territories.editor.field.index",
            Auth()
                ->user()
                ->currentTeam->territories->first()->id
        );
    }
}
