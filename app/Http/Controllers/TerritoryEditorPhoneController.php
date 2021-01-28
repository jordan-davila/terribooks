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
    public function index(Territory $territory)
    {
        Gate::denies('view', $territory) ? abort(403, "You Don't Have Access to that Territory") : null;
        $default_street = $territory->streets->first();
        if (!is_null($default_street)) {
            return Redirect::route('territories.editor.phone.show', ['territory' => $territory, 'street' => $default_street]);
        }
        return Inertia::render('Territories/Editor/Phone');
    }

    public function show(Territory $territory, Street $street)
    {
        Gate::denies('view', $territory) ? abort(403, "You Don't Have Access to that Territory") : null;
        return Inertia::render('Territories/Editor/Phone', [
            'territory' => new TerritoryResource($territory),
            'street' => $street,
            'phones' => $territory->phones,
        ]);
    }
}
