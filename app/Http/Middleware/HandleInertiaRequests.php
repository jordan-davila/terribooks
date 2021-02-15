<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use App\Http\Resources\TeamResource;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = "app";

    public function version(Request $request)
    {
        return parent::version($request);
    }

    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            // Synchronously
            "territories" => function () {
                return Auth()->user() ? new TeamResource(Auth()->user()->currentTeam) : null;
            },

            // 'flash' => function () use ($request) {
            //     return $request->session()->get('flash');
            // },

            "search" => function () use ($request) {
                return $request->session()->get("search");
            },
        ]);
    }
}
