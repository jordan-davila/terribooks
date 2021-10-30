<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Phone;
use App\Models\Street;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TerritoryResource;

class TerritoryEditorPhoneController extends Controller
{
    public function show(Territory $territory, Street $street = null)
    {
        $default = is_null($street) ? $territory->streets->first() : $street;
        if (!is_null($default)) {
            return Inertia::render("Territories/Editor/Phone", [
                "type" => "Phone",
                "territory" => new TerritoryResource($territory),
                "street" => $default,
                "phones" => $default->phones,
            ]);
        } else {
            return Inertia::render("Territories/Editor/Index", [
                "territory" => new TerritoryResource($territory),
            ]);
        }
    }

    public function store(Territory $territory, Street $street, Request $request)
    {
        $request->validate([
            "number" => "required|min:1",
            "street_id" => "required",
        ]);

        try {
            Phone::create([
                "name" => $request->name,
                "number" => $request->number,
                "phone" => $request->phone,
                "apartment" => $request->apartment,
                "symbol" => $request->symbol,
                "color" => $request->color,
                "observations" => $request->observations,
                "street_id" => $street->id,
            ]);
        } catch (\Throwable $th) {
            request()->session()->flash("flash.alertStyle", "danger");
            $th->errorInfo[1] === 1062 ?
                request()->session()->flash("flash.alert", "Duplicate Entry Error: " . $th->errorInfo[1]) :
                request()->session()->flash("flash.alert", "Something Crashed. Error: " . $th->errorInfo[1]);
        }

        return back(303);
    }

    public function update(Territory $territory, Street $street, Phone $phone, Request $request)
    {
        Gate::allows("handlePhone", [$territory, $phone]) ?: abort(403);

        $request->validate(["number" => "required|min:1"]);

        // Make sure its actually from the users territory and street
        $phone = $territory
            ->streets()
            ->find($street->id)
            ->phones()
            ->find($request->id);
        $phone->number = $request->number;
        $phone->apartment = $request->apartment;
        $phone->name = $request->name;
        $phone->symbol = $request->symbol;
        $phone->color = $request->color;
        $phone->phone = $request->phone;
        $phone->observations = $request->observations;

        try {
            $phone->save();
        } catch (\Throwable $th) {
            request()->session()->flash("flash.alertStyle", "danger");
            $th->errorInfo[1] === 1062 ?
                request()->session()->flash("flash.alert", "Duplicate Entry Error: " . $th->errorInfo[1]) :
                request()->session()->flash("flash.alert", "Something Crashed. Error: " . $th->errorInfo[1]);
        }

        return back(303);
    }

    public function updateAll(Territory $territory, Street $street, Request $request)
    {
        // Don't need a gate here since we're already checking it on update()
        foreach ($request->phones as $phone) {
            $this->update($territory, $street, new Phone($phone), new Request($phone));
        }

        return back(303);
    }

    public function deleteSelected(Territory $territory, Street $street, Request $request)
    {
        foreach ($request->phones as $req) {
            $phone = Phone::find($req["id"]);
            Gate::allows("handlePhone", [$territory, $phone]) ?: abort(403);
            $phone->delete();
        }

        return back(303);
    }
}
