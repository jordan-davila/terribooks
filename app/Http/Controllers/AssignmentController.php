<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Publisher;
use App\Models\Territory;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\PublisherResource;
use App\Http\Resources\TerritoryResource;
use VerumConsilium\Browsershot\Facades\PDF;

class AssignmentController extends Controller
{
    public function index($type)
    {
        $type === "field" || $type === "phone" || $type === "business" ? null : abort(404);

        // Check for first territory
        $default = Auth()->user()->currentTeam;
        return !is_null($default) ? Redirect::route("assignments.type.show", ["type" => $type, "territory" => $default->territories->first()]) : abort(404);
    }

    public function showByType($type, Territory $territory)
    {
        $type === "field" || $type === "phone" || $type === "business" ? null : abort(404);
        $assignments = Auth()
            ->user()
            ->currentTeam->assignments()
            ->with("publisher")
            ->with("territory")
            ->where("type", $type)
            ->join("territories", "territories.id", "=", "assignments.territory_id")
            ->orderByRaw("CAST(`order` AS UNSIGNED) ASC");

        return Inertia::render("Territories/Assignments/Type", [
            "type" => $type,
            "territory" => new TerritoryResource($territory),
            "publishers" => PublisherResource::collection(
                Auth()
                    ->user()
                    ->currentTeam->publishers->all()
            ),
            "current_assignments" => with(clone $assignments)
                ->where("current", true)
                ->get(),
            "past_assignments" => with(clone $assignments)
                ->where("territory_id", $territory->id)
                ->where("current", false)
                ->orderBy("date_out", "desc")
                ->get(),
        ]);
    }

    public function showByPublisher(Publisher $publisher)
    {
        $assignments = Auth()
            ->user()
            ->currentTeam->assignments()
            ->with("publisher")
            ->with("territory")
            ->where("publisher_id", $publisher->id)
            ->join("territories", "territories.id", "=", "assignments.territory_id")
            ->orderByRaw("CAST(`order` AS UNSIGNED) ASC");
        return Inertia::render("Territories/Assignments/Publisher", [
            "publisher" => $publisher,
            "publishers" => PublisherResource::collection(
                Auth()
                    ->user()
                    ->currentTeam->publishers->all()
            ),
            "current_assignments" => with(clone $assignments)
                ->where("current", true)
                ->get(),
            "past_assignments" => with(clone $assignments)
                ->where("current", false)
                ->orderBy("date_out", "desc")
                ->paginate(30),
        ]);
    }

    public function markAsComplete(Assignment $assignment, Request $request)
    {
        Assignment::create([
            "team_id" => $assignment->team_id,
            "territory_id" => $assignment->territory_id,
            "publisher_id" => $request->publisher_id,
            "date_in" => $request->date_in ? Carbon::parse($request->date_in) : null,
            "date_out" => $request->date_out ? Carbon::parse($request->date_out) : null,
            "type" => $assignment->type,
            "current" => false,
        ]);

        $assignment->publisher_id = null;
        $assignment->date_in = null;
        $assignment->date_out = null;
        $assignment->save();

        return back(303);
    }

    public function update(Assignment $assignment, Request $request)
    {
        // Make sure its actually from the users territory and street
        $assignment->team_id = $request->team_id;
        $assignment->territory_id = $request->territory_id;
        $assignment->publisher_id = $request->publisher_id;
        $assignment->date_in = $request->date_in ? Carbon::parse($request->date_in) : null;
        $assignment->date_out = $request->date_out ? Carbon::parse($request->date_out) : null;
        $assignment->type = $request->type;
        $assignment->save();

        return back(303);
    }

    public function updateAll(Request $request)
    {
        // Don't need a gate here since we're already checking it on update()
        foreach ($request->assignments as $assignment) {
            $this->update(Assignment::find($assignment["id"]), new Request($assignment));
        }

        return back(303);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->assignments as $req) {
            $assignment = Assignment::find($req["id"]);
            $assignment->delete();
        }

        return back(303);
    }

    public function download($type)
    {
        $type === "field" || $type === "phone" || $type === "business" ? null : abort(404);
        $team = Auth()->user()->currentTeam;
        $territories = $team->territories;
        $columns = $territories->map(function ($territory) use ($type) {
            $column = [];
            $column["territory"] = $territory;
            $column["assignments"] = array_merge(
                $territory
                    ->assignments()
                    ->where("type", $type)
                    ->where("current", true)
                    ->with("publisher")
                    ->limit(1)
                    ->get()
                    ->toArray(),
                $territory
                    ->assignments()
                    ->where("type", $type)
                    ->where("current", false)
                    ->orderBy("date_out", "desc")
                    ->limit(5)
                    ->with("publisher")
                    ->get()
                    ->toArray()
            );

            $difference = 18 - count($column["assignments"]);
            for ($i = 0; $i < $difference; $i++) {
                $column["assignments"][] = ["id" => null];
            }
            return $column;
        });

        $difference = 5 - (count($columns) % 5);
        for ($i = 0; $i < $difference; $i++) {
            $columns[] = [
                "territory" => null,
                "assignments" => array_fill(0, 18, ["id" => null]),
            ];
        }

        return PDF::loadView("export.assignment", [
            "spreadsheets" => $columns->chunk(5),
            "congregation" => $team,
            "type" => $type,
        ])
            ->format("Letter")
            ->inline($team->name . "_Assignments.pdf");
    }
}
