<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Street;
use App\Models\Business;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TerritoryResource;

class TerritoryEditorBusinessController extends Controller
{
    public function index(Territory $territory)
    {
        $default = $territory->streets->first();
        return !is_null($default) ? Redirect::route("territories.editor.business.show", ["territory" => $territory, "street" => $default]) : abort(403);
    }

    public function show(Territory $territory, Street $street)
    {
        return Inertia::render("Territories/Editor/Business", [
            "type" => "Business",
            "territory" => new TerritoryResource($territory),
            "street" => $street,
            "businesses" => $street->businesses,
        ]);
    }

    public function store(Territory $territory, Street $street, Request $request)
    {
        $request->validate([
            "number" => "required|min:1",
            "street_id" => "required",
        ]);

        Business::create([
            "name" => $request->name,
            "number" => $request->number,
            "phone" => $request->phone,
            "symbol" => $request->symbol,
            "color" => $request->color,
            "observations" => $request->observations,
            "street_id" => $street->id,
        ]);

        return back(303);
    }

    public function update(Territory $territory, Street $street, Business $business, Request $request)
    {
        Gate::allows("handleBusiness", [$territory, $business]) ?: abort(403);

        $request->validate(["number" => "required|min:1"]);

        // Make sure its actually from the users territory and street
        $business = $territory
            ->streets()
            ->find($street->id)
            ->businesses()
            ->find($request->id);
        $business->number = $request->number;
        $business->name = $request->name;
        $business->symbol = $request->symbol;
        $business->color = $request->color;
        $business->phone = $request->phone;
        $business->observations = $request->observations;
        $business->save();

        return back(303);
    }

    public function updateAll(Territory $territory, Street $street, Request $request)
    {
        // Don't need a gate here since we're already checking it on update()
        foreach ($request->businesses as $business) {
            $this->update($territory, $street, new Business($business), new Request($business));
        }

        return back(303);
    }

    public function deleteSelected(Territory $territory, Street $street, Request $request)
    {
        foreach ($request->businesses as $req) {
            $business = Business::find($req["id"]);
            Gate::allows("handleBusiness", [$territory, $business]) ?: abort(403);
            $business->delete();
        }

        return back(303);
    }
}
