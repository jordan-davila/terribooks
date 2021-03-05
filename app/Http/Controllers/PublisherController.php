<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PublisherController extends Controller
{
    public function store(Team $team, Request $request)
    {
        $request->validate(["name" => "required|min:3"]);

        $publisher = $team->publishers()->create([
            "team_id" => $team->id,
            "name" => $request["name"],
        ]);

        return back(303);
    }

    public function update(Team $team, Publisher $publisher, Request $request)
    {
        $request->validate(["name" => "required|min:3"]);
        $publisher->name = $request["name"];
        $publisher->save();

        return back(303);
    }

    public function destroy(Team $team, Publisher $publisher)
    {
        $publisher->delete();
        return Redirect::route("assignments.type.show", [
            "field",
            Auth()
                ->user()
                ->currentTeam->territories->first()->id,
        ]);
    }
}
