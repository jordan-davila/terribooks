<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DashboardController;

Route::get("/", [HomeController::class, "index"])->name("welcome");

Route::get("/test", function () {
    request()
        ->session()
        ->flash("flash.alert", "Yay it works!");
    request()
        ->session()
        ->flash("flash.alertStyle", "success");
    return back();
});

Route::middleware(["auth:sanctum", "verified"])->group(function () {
    // Main Dashboard
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
    // Search
    Route::get("/search/team/{team}", [SearchController::class, "search"])->name("search");
});
