<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\House;
use App\Models\Street;
use App\Models\Apartment;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TerritoryResource;

class TerritoryEditorFieldController extends Controller
{
    public function show(Territory $territory, Street $street = null)
    {
        $default = is_null($street) ? $territory->streets->first() : $street;
        if (!is_null($default)) {
            return Inertia::render("Territories/Editor/Field", [
                "type" => "Field",
                "territory" => new TerritoryResource($territory),
                "street" => $default,
                "houses" => $default
                    ->houses()
                    ->with("apartments")
                    ->get(),
            ]);
        } else {
            return Inertia::render("Territories/Editor/Index", [
                "territory" => new TerritoryResource($territory),
            ]);
        }
    }

    public function storeHouse(Territory $territory, Street $street, Request $request)
    {
        $request->validate([
            "number" => "required|min:1",
            "type" => "required|max:1",
            "symbol" => "required|max:3",
        ]);

        House::create([
            "number" => $request->number,
            "type" => $request->type,
            "observations" => $request->observations,
            "symbol" => $request->symbol,
            "color" => $request->color,
            "street_id" => $street->id,
        ]);

        return back(303);
    }

    public function storeApartment(Territory $territory, Street $street, Request $request)
    {
        $request->validate([
            "number" => "required|min:1",
            "symbol" => "required|max:3",
        ]);

        try {
            Apartment::create([
                "number" => $request->number,
                "observations" => $request->observations,
                "symbol" => $request->symbol,
                "color" => $request->color,
                "house_id" => $request->house_id,
            ]);
        } catch (\Throwable $th) {
            request()->session()->flash("flash.alertStyle", "danger");
            $th->errorInfo[1] === 1062 ?
                request()->session()->flash("flash.alert", "Duplicate Entry Error: ". $th->errorInfo[1]) :
                request()->session()->flash("flash.alert", "Something Crashed. Error: " . $th->errorInfo[1]);
        }

        return back(303);
    }

    public function updateHouse(Territory $territory, Street $street, House $house, Request $request)
    {
        Gate::allows("handleHouse", [$territory, $house]) ?: abort(403);

        $request->validate([
            "number" => "required|min:1",
            "type" => "required|max:1",
            "symbol" => "required|max:3",
        ]);

        // Make sure its actually from the users territory and street
        $house = $territory
            ->streets()
            ->find($street->id)
            ->houses()
            ->find($request->id);
        $house->number = $request->number;
        $house->type = $request->type;
        $house->observations = $request->observations;
        $house->symbol = $request->symbol;
        $house->color = $request->color;

        try { $house->save(); } catch (\Throwable $th) {
            request()->session()->flash("flash.alertStyle", "danger");
            $th->errorInfo[1] === 1062 ?
                request()->session()->flash("flash.alert", "Duplicate Entry Error: ". $th->errorInfo[1]) :
                request()->session()->flash("flash.alert", "Something Crashed. Error: " . $th->errorInfo[1]);
        }

        return back(303);
    }

    public function updateApartment(Territory $territory, Street $street, Apartment $apartment, Request $request)
    {
        Gate::allows("handleHouse", [$territory, House::find($apartment->house_id)]) ?: abort(403);

        $request->validate([
            "number" => "required|min:1",
            "symbol" => "required|max:3",
        ]);

        $apartment = $territory
            ->streets()
            ->find($street->id)
            ->houses()
            ->find($request->house_id)
            ->apartments()
            ->find($request->id);
        $apartment->number = $request->number;
        $apartment->observations = $request->observations;
        $apartment->symbol = $request->symbol;
        $apartment->color = $request->color;

        try { $apartment->save(); } catch (\Throwable $th) {
            request()->session()->flash("flash.alertStyle", "danger");
            $th->errorInfo[1] === 1062 ?
                request()->session()->flash("flash.alert", "Duplicate Entry Error: ". $th->errorInfo[1]) :
                request()->session()->flash("flash.alert", "Something Crashed. Error: " . $th->errorInfo[1]);
        }

        return back(303);
    }

    public function updateAll(Territory $territory, Street $street, Request $request)
    {
        // Don't need a gate here since we're already checking it on update()
        foreach ($request->houses as $house) {
            $this->updateHouse($territory, $street, new House($house), new Request($house));

            if (!is_null($house["apartments"])) {
                foreach ($house["apartments"] as $apartment) {
                    $this->updateApartment($territory, $street, new Apartment($apartment), new Request($apartment));
                }
            }
        }

        return back(303);
    }

    public function deleteSelectedHouses(Territory $territory, Street $street, Request $request)
    {
        foreach ($request->houses as $req) {
            $house = House::find($req["id"]);
            Gate::allows("handleHouse", [$territory, $house]) ?: abort(403);
            $house->delete();
        }

        return back(303);
    }

    public function deleteSelectedApartments(Territory $territory, Street $street, Request $request)
    {
        foreach ($request->apartments as $req) {
            $apartment = Apartment::find($req["id"]);
            // Gate::allows('handleHouse', [$territory, $apartment->house]) ?: abort(403);
            $apartment->delete();
        }

        return back(303);
    }
}
