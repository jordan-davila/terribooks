<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\TerritoryEditorFieldController;
use App\Http\Controllers\TerritoryEditorPhoneController;
use App\Http\Controllers\TerritoryEditorBusinessController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Territories Group
    Route::group(['prefix' => 'territories', 'as' => 'territories.'], function () {
        Route::get('/', [TerritoryController::class, 'index'])
            ->name('index');
        Route::get('/{territory}', [TerritoryController::class, 'show'])
            ->name('show');
        Route::get('/{territory}/map', [TerritoryController::class, 'map'])
            ->name('territories.map.show');

        // Editor Group
        Route::group(['prefix' => '{territory}/editor', 'as' => 'editor.'], function () {
            // Redirecters
            Route::get('/field', [TerritoryEditorFieldController::class, 'index'])
                ->name('field.index');
            Route::get('/phone', [TerritoryEditorPhoneController::class, 'index'])
                ->name('phone.index');
            Route::get('/business', [TerritoryEditorBusinessController::class, 'index'])
                ->name('business.index');

            // Selectors
            Route::get('/field/street/{street}', [TerritoryEditorFieldController::class, 'show'])
                ->name('field.show');
            Route::get('/phone/street/{street}', [TerritoryEditorPhoneController::class, 'show'])
                ->name('phone.show');
            Route::get('/business/street/{street}', [TerritoryEditorBusinessController::class, 'show'])
                ->name('business.show');
        });
    });
});
