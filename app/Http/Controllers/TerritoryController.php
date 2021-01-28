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
        // Check for first territory
        // If not, render territory.index
        $default_territory = Auth()->user()->currentTeam->territories->first();
        if (!is_null($default_territory)) {
            return Redirect::route('territories.show', ['territory' => $default_territory]);
        }

        return Inertia::render('Territories/Overview/Index');
    }

    public function show(Territory $territory)
    {
        Gate::denies('view', $territory) ? abort(403, "You Don't Have Access to that Territory") : null;
        // *NOTE* TerritoryPicker.vue uses data ('territories') from HandleInertiaRequest Middleware
        // Since this is data that we want to access a number of pages, it will be unpractical to
        // make a request on every page. For this reason, we use Inertia's Shared Data feature
        return Inertia::render('Territories/Overview/Show', [
            'territory' => new TerritoryResource($territory),
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
