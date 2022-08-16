<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render("Dashboard");
    }

    public function updateTheme(Request $request)
    {
        $user = $request->user();
        $user->theme = $user->theme === 'dark' ? 'light' : 'dark';

        try {
            $user->save();
        } catch (\Throwable $th) {
            request()->session()->flash("flash.alertStyle", "danger");
            request()->session()->flash("flash.alert", "Theme Swithcher Error: " . $th->errorInfo[1]);
        }
        return back(303);
        // return response()->json(['theme' => $user->theme]);
    }
}
