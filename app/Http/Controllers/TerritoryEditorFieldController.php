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
    public function index(Territory $territory)
    {
        $default = $territory->streets->first();
        return !is_null($default)
            ? Redirect::route('territories.editor.field.show', ['territory' => $territory, 'street' => $default])
            : Inertia::render('Territories/Editor/Field');
    }

    public function show(Territory $territory, Street $street)
    {
        return Inertia::render('Territories/Editor/Field', [
            'type' => 'Field',
            'territory' => new TerritoryResource($territory),
            'street' => $street,
            'houses' => $street->houses()->with('apartments')->get(),
        ]);
    }

    public function storeHouse(Territory $territory, Street $street, Request $request)
    {
        $request->validate([
            'number' => 'required|min:1',
            'type' => 'required|max:1',
            'symbol' => 'required|max:3',
        ]);

        House::create([
            'number' => $request->number,
            'type' => $request->type,
            'observations' => $request->observations,
            'symbol' => $request->symbol,
            'color' => $request->color,
            'street_id' => $street->id,
        ]);

        return back(303);
    }

    public function storeApartment(Territory $territory, Street $street, Request $request)
    {
        $request->validate([
            'number' => 'required|min:1',
            'symbol' => 'required|max:3',
        ]);

        Apartment::create([
            'number' => $request->number,
            'observations' => $request->observations,
            'symbol' => $request->symbol,
            'color' => $request->color,
            'house_id' => $request->house_id,
        ]);

        return back(303);
    }

    public function updateHouse(Territory $territory, Street $street, House $house, Request $request)
    {
        Gate::allows('handleHouse', [$territory, $house]) ?: abort(403);

        $request->validate([
            'number' => 'required|min:1',
            'type' => 'required|max:1',
            'symbol' => 'required|max:3',
        ]);

        // Make sure its actually from the users territory and street
        $house = $territory->streets()->find($street->id)->houses()->find($request->id);
        $house->number = $request->number;
        $house->type = $request->type;
        $house->observations = $request->observations;
        $house->symbol = $request->symbol;
        $house->color = $request->color;
        $house->save();

        return back(303);
    }

    public function updateApartment(Territory $territory, Street $street, Apartment $apartment, Request $request)
    {
        Gate::allows('handleHouse', [$territory, House::find($apartment->house_id)]) ?: abort(403);

        $request->validate([
            'number' => 'required|min:1',
            'symbol' => 'required|max:3',
        ]);

        $apartment = $territory
            ->streets()->find($street->id)
            ->houses()->find($request->house_id)
            ->apartments()->find($request->id);
        $apartment->number = $request->number;
        $apartment->observations = $request->observations;
        $apartment->symbol = $request->symbol;
        $apartment->color = $request->color;
        $apartment->save();

        return back(303);
    }

    public function updateAll(Territory $territory, Street $street, Request $request)
    {
        // Don't need a gate here since we're already checking it on update()
        foreach ($request->houses as $house) {
            $this->updateHouse($territory, $street, new House($house), new Request($house));

            if (!is_null($house['apartments'])) {
                foreach ($house['apartments'] as $apartment) {
                    $this->updateApartment($territory, $street, new Apartment($apartment), new Request($apartment));
                }
            }
        }

        return back(303);
    }
}
