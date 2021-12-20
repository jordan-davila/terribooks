<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\TerritoryController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TerritoryEditorFieldController;
use App\Http\Controllers\TerritoryEditorPhoneController;
use App\Http\Controllers\TerritoryExportFieldController;
use App\Http\Controllers\TerritoryExportPhoneController;
use App\Http\Controllers\TerritoryEditorBusinessController;
use App\Http\Controllers\TerritoryExportBusinessController;

// prettier-ignore
Route::middleware(["auth:sanctum", "verified"])->group(function () {

    Route::put("/theme", [DashboardController::class, "updateTheme"])->name("theme.update");

    // Cities
    Route::group(["prefix" => "/settings/team/{team}", "as" => "teams.", "middleware" => "can:view,team"], function () {
        Route::post("/city/store", [CityController::class, "store"])->name("city.store");
        Route::put("/city/{city}", [CityController::class, "update"])->name("city.update");
        Route::delete("/city/{city}", [CityController::class, "destroy"])->name("city.delete");
    });

    // Publishers
    Route::group(["prefix" => "/settings/team/{team}", "as" => "teams.", "middleware" => "can:view,team"], function () {
        Route::post("/publisher/store", [PublisherController::class, "store"])->name("publisher.store");
        Route::put("/publisher/{publisher}", [PublisherController::class, "update"])->name("publisher.update");
        Route::delete("/publisher/{publisher}", [PublisherController::class, "destroy"])->name("publisher.delete");
    });

    // Redirect to Default Territory
    Route::get("/territories", [TerritoryController::class, "index"])
        ->name("territories.index");
    Route::post("/territories/store", [TerritoryController::class, "store"])
        ->name("territories.store");

    // Route::group(["middleware" => "can:handleTerritory,territory"], function () {
    //     Route::put("/territories/{territory}", [TerritoryController::class, "update"])
    //     ->name("territories.update");
    //     Route::put("/territories/{territory}", [TerritoryController::class, "updateCoordinates"])
    //     ->name("territories.update.coordinates");
    //     Route::delete("/territories/{territory}", [TerritoryController::class, "destroy"])
    //     ->name("territories.delete");
    // });

    // Assignments
    Route::group(["prefix" => "/assignments", "as" => "assignments."], function () {
        Route::get("/type/{type}", [AssignmentController::class, "index"])
            ->name("type.index");
        Route::get("/type/{type}/territory/{territory}", [AssignmentController::class, "showByType"])
            ->name("type.show");
        Route::get("/publisher/{publisher}", [AssignmentController::class, "showByPublisher"])
            ->name("publisher.show");
        Route::put("/", [AssignmentController::class, "updateAll"])->name("update.all");
        Route::delete("/", [AssignmentController::class, "deleteSelected"])->name("delete.selected");
        Route::put("/{assignment}", [AssignmentController::class, "update"])->name("update");
        Route::get("/type/{type}/download/", [AssignmentController::class, "download"])->name("download");
        Route::put("/{assignment}/mark/complete", [AssignmentController::class, "markAsComplete"])->name("mark.complete");
    });

    // Territories Group
    Route::group(
        [
            "middleware" => "can:handleTerritory,territory",
            "prefix" => "territories",
            "as" => "territories.",
        ],
        function () {
            Route::put("/{territory}", [TerritoryController::class, "update"])
                ->name("update");
            Route::put("/{territory}/coordinates", [TerritoryController::class, "updateCoordinates"])
                ->name("update.coordinates");
            Route::delete("/{territory}", [TerritoryController::class, "destroy"])
                ->name("delete");

            // None Editor Routes
            Route::get("/{territory}", [TerritoryController::class, "show"])
                ->name("show");
            Route::get("/{territory}/map", [TerritoryController::class, "map"])
                ->name("map.show");

            // Print Group
            Route::group(["prefix" => "{territory}/export", "as" => "export."], function () {
                Route::get("/field/download", [TerritoryExportFieldController::class, "download"])
                    ->name("field.download");
                Route::get("/phone/download", [TerritoryExportPhoneController::class, "download"])
                    ->name("phone.download");
                Route::get("/business/download", [TerritoryExportBusinessController::class, "download"])
                    ->name("business.download");
            });

            // Editor Group
            Route::group(["prefix" => "{territory?}/editor", "as" => "editor."], function () {
                // Streets [Store, Update, UpdateOrder, Delete]
                Route::post("/street", [StreetController::class, "store"])
                    ->name("street.store");
                Route::put("/street/{street}", [StreetController::class, "update"])
                    ->name("street.update");
                Route::put("/street", [StreetController::class, "updateOrder"])
                    ->name("street.update.order");
                Route::delete("/street/{street}", [StreetController::class, "destroy"])
                    ->name("street.delete");

                // Redirect to Default Street -> territories/editor/{type}/street/{street}
                Route::get("/field", [TerritoryEditorFieldController::class, "show"])
                    ->name("field.index");
                Route::get("/phone", [TerritoryEditorPhoneController::class, "show"])
                    ->name("phone.index");
                Route::get("/business", [TerritoryEditorBusinessController::class, "show"])
                    ->name("business.index");

                // Middleware: Check if street belongs to the selected territory
                Route::group(["middleware" => "can:handleStreet,territory,street"], function () {
                    // Field [Show, Store, Update, UpdateAll, Destroy]
                    Route::get("/field/street/{street?}", [TerritoryEditorFieldController::class, "show"])
                        ->name("field.show");
                    Route::post("/field/street/{street}/house", [TerritoryEditorFieldController::class, "storeHouse"])
                        ->name("field.store.house");
                    Route::post("/field/street/{street}/apartment", [TerritoryEditorFieldController::class, "storeApartment"])
                        ->name("field.store.apartment");
                    Route::put("/field/street/{street}/house/{house}", [TerritoryEditorFieldController::class, "updateHouse"])
                        ->name("field.update.house");
                    Route::put("/field/street/{street}/apartment/{apartment}", [TerritoryEditorFieldController::class, "updateApartment"])
                        ->name("field.update.apartment");
                    Route::put(
                        "/field/street/{street}",
                        [TerritoryEditorFieldController::class, "updateAll"]
                    )->name("field.update.all");
                    Route::delete("/field/street/{street}/house", [TerritoryEditorFieldController::class, "deleteSelectedHouses"])
                        ->name("field.delete.selected.houses");
                    Route::delete("/field/street/{street}/apartment", [TerritoryEditorFieldController::class, "deleteSelectedApartments"])
                        ->name("field.delete.selected.apartments");

                    // Phone [Show, Store, Update, UpdateAll, Destroy]
                    Route::get("/phone/street/{street?}", [TerritoryEditorPhoneController::class, "show"])
                        ->name("phone.show");
                    Route::post(
                        "/phone/street/{street}",
                        [TerritoryEditorPhoneController::class, "store"]
                    )->name("phone.store");
                    Route::put("/phone/street/{street}/{phone}", [TerritoryEditorPhoneController::class, "update"])
                        ->name("phone.update");
                    Route::put(
                        "/phone/street/{street}",
                        [TerritoryEditorPhoneController::class, "updateAll"]
                    )->name("phone.update.all");
                    Route::delete("/phone/street/{street}", [TerritoryEditorPhoneController::class, "deleteSelected"])
                        ->name("phone.delete.selected");

                    // Business [Show, Store, Update, UpdateAll, Destroy]
                    Route::get("/business/street/{street}", [TerritoryEditorBusinessController::class, "show"])
                        ->name("business.show");
                    Route::post(
                        "/business/street/{street}",
                        [TerritoryEditorBusinessController::class, "store"]
                    )->name("business.store");
                    Route::put("/business/street/{street}/{business}", [TerritoryEditorBusinessController::class, "update"])
                        ->name("business.update");
                    Route::put(
                        "/business/street/{street}",
                        [TerritoryEditorBusinessController::class, "updateAll"]
                    )->name("business.update.all");
                    Route::delete("/business/street/{street}", [TerritoryEditorBusinessController::class, "deleteSelected"])
                        ->name("business.delete.selected");
                });
            });
        }
    );
});
