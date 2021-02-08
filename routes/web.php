<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\TerritoryEditorFieldController;
use App\Http\Controllers\TerritoryEditorPhoneController;
use App\Http\Controllers\TerritoryEditorBusinessController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Main Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Search
    Route::get('/search/team/{team}', [SearchController::class, 'search'])
        ->name('search');

    // Redirect to Default Territory
    Route::get('/territories', [TerritoryController::class, 'index'])
        ->name('territories.index');


    // Territories Group
    Route::group([
        'middleware' => 'can:handleTerritory,territory',
        'prefix' => 'territories',
        'as' => 'territories.'
    ], function () {

        // None Editor Routes
        Route::get('/{territory}', [TerritoryController::class, 'show'])
            ->name('show');
        Route::get('/{territory}/map', [TerritoryController::class, 'map'])
            ->name('territories.map.show');

        // Editor Group
        Route::group(['prefix' => '{territory}/editor', 'as' => 'editor.'], function () {

            // Streets [Store, Update, UpdateOrder, Delete]
            Route::post('/street', [StreetController::class, 'store'])
                ->name('street.store'); // territories.editor.street.store
            Route::put('/street/{street}', [StreetController::class, 'update'])
                ->name('street.update'); // territories.editor.street.update
            Route::put('/street', [StreetController::class, 'updateOrder'])
                ->name('street.update.order'); // territories.editor.street.update.order

            // Redirect to Default Street -> territories/editor/{type}/street/{street}
            Route::get('/field', [TerritoryEditorFieldController::class, 'index'])
                ->name('field.index'); // territories.editor.field.index
            Route::get('/phone', [TerritoryEditorPhoneController::class, 'index'])
                ->name('phone.index'); // territories.editor.phone.index
            Route::get('/business', [TerritoryEditorBusinessController::class, 'index'])
                ->name('business.index'); // territories.editor.business.index


            // Middleware: Check if street belongs to the selected territory
            Route::group(['middleware' => 'can:handleStreet,territory,street'], function () {

                // Field [Show, Store, Update, UpdateAll, Destroy]
                Route::get('/field/street/{street}', [TerritoryEditorFieldController::class, 'show'])
                    ->name('field.show'); // territories.editor.field.show
                Route::post('/field/street/{street}/house', [TerritoryEditorFieldController::class, 'storeHouse'])
                    ->name('field.store.house'); // territories.editor.field.store.house
                Route::post('/field/street/{street}/apartment', [TerritoryEditorFieldController::class, 'storeApartment'])
                    ->name('field.store.apartment'); // territories.editor.field.store.apt
                Route::put('/field/street/{street}/house/{house}', [TerritoryEditorFieldController::class, 'updateHouse'])
                    ->name('field.update.house'); // territories.editor.field.update.house
                Route::put('/field/street/{street}/apt/{apt}', [TerritoryEditorFieldController::class, 'updateApartment'])
                    ->name('field.update.apt'); // territories.editor.field.update.apt
                Route::put('/field/street/{street}', [TerritoryEditorFieldController::class, 'updateAll'])
                    ->name('field.update.all'); // territories.editor.field.update.all

                // Phone [Show, Store, Update, UpdateAll, Destroy]
                Route::get('/phone/street/{street}', [TerritoryEditorPhoneController::class, 'show'])
                    ->name('phone.show'); // territories.editor.phone.show
                Route::post('/phone/street/{street}', [TerritoryEditorPhoneController::class, 'store'])
                    ->name('phone.store'); // territories.editor.phone.store
                Route::put('/phone/street/{street}/{phone}', [TerritoryEditorPhoneController::class, 'update'])
                    ->name('phone.update'); // territories.editor.phone.update
                Route::put('/phone/street/{street}', [TerritoryEditorPhoneController::class, 'updateAll'])
                    ->name('phone.update.all'); // territories.editor.phone.update.all
                Route::delete('/phone/street/{street}', [TerritoryEditorPhoneController::class, 'deleteSelected'])
                    ->name('phone.delete.selected'); // territories.editor.phone.update.all

                // Business [Show, Store, Update, UpdateAll, Destroy]
                Route::get('/business/street/{street}', [TerritoryEditorBusinessController::class, 'show'])
                    ->name('business.show'); // territories.editor.business.show
                Route::post('/business/street/{street}', [TerritoryEditorBusinessController::class, 'store'])
                    ->name('business.store'); // territories.editor.business.store
                Route::put('/business/street/{street}/{business}', [TerritoryEditorBusinessController::class, 'update'])
                    ->name('business.update'); // territories.editor.business.update
                Route::put('/business/street/{street}', [TerritoryEditorBusinessController::class, 'updateAll'])
                    ->name('business.update.all'); // territories.editor.business.update.all
            });
        });
    });
});
