<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Inertia\Inertia;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\TerritoryResource;

class TerritoryController extends Controller
{
    public function index()
    {
        $default = Auth()->user()->currentTeam;
        return !is_null($default) ? Redirect::route("territories.show", ["territory" => $default->territories->first()]) : Inertia::render("Territories/Overview/Index");
    }

    public function show(Territory $territory)
    {
        return Inertia::render("Territories/Overview/Show", [
            "territory" => new TerritoryResource($territory),
        ]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit(Territory $territory)
    {
    }

    public function update(Request $request, Territory $territory)
    {
    }

    public function destroy(Territory $territory)
    {
    }
}
