<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DashboardController;

Route::get("/", [HomeController::class, "index"])->name("welcome");

Route::middleware(["auth:sanctum", "verified"])->group(function () {
    // Main Dashboard
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
    // Search
    Route::get("/search/team/{team}", [SearchController::class, "search"])->name("search");
});
