<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Aspects\FieldSearchAspect;
use App\Aspects\PhoneSearchAspect;
use App\Aspects\StreetSearchAspect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class SearchController extends Controller
{
    public function search(Team $team, Request $request)
    {
        Gate::allows('view', $team) ?: abort(403);
        if ($request->has('query')) {
            if ($request->input('query') != '') {
                $query = $request->input('query');
                $searchResults = (new Search())
                    ->registerAspect(FieldSearchAspect::class)->limitAspectResults(10)
                    ->registerAspect(PhoneSearchAspect::class)->limitAspectResults(10)
                    ->registerAspect(StreetSearchAspect::class)->limitAspectResults(10)
                    ->search($query);
                return back()->with(['search' => $searchResults->groupByType()]);
            } else {
                return back();
            }
        }
    }
}
