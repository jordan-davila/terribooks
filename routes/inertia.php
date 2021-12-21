<?php

use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;
use Laravel\Jetstream\Http\Controllers\Inertia\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Inertia\TeamMemberController;
use Laravel\Jetstream\Http\Controllers\Inertia\CurrentUserController;
use Laravel\Jetstream\Http\Controllers\Inertia\ProfilePhotoController;
use Laravel\Jetstream\Http\Controllers\Inertia\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Inertia\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Inertia\OtherBrowserSessionsController;
// Custom Controllers
use App\Http\Controllers\CurrentTeamController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CongregationController;

Route::group(["middleware" => config("jetstream.middleware", ["web"])], function () {
    if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
        Route::get("/terms-of-service", [TermsOfServiceController::class, "show"])->name("terms.show");
        Route::get("/privacy-policy", [PrivacyPolicyController::class, "show"])->name("policy.show");
    }

    Route::group(["middleware" => ["auth", "verified"]], function () {
        // User & Profile...
        Route::get("/settings/maintenance", function () {
            return Inertia::render("Settings/Maintenance");
        })->name("settings.maintenance");
        Route::get("/settings/profile", [UserProfileController::class, "show"])->name("profile.show");

        Route::delete("/settings/other-browser-sessions", [OtherBrowserSessionsController::class, "destroy"])->name("other-browser-sessions.destroy");

        Route::delete("/settings/profile-photo", [ProfilePhotoController::class, "destroy"])->name("current-user-photo.destroy");

        if (Jetstream::hasAccountDeletionFeatures()) {
            Route::delete("/user", [CurrentUserController::class, "destroy"])->name("current-user.destroy");
        }

        // API...
        if (Jetstream::hasApiFeatures()) {
            Route::get("/user/api-tokens", [ApiTokenController::class, "index"])->name("api-tokens.index");
            Route::post("/user/api-tokens", [ApiTokenController::class, "store"])->name("api-tokens.store");
            Route::put("/user/api-tokens/{token}", [ApiTokenController::class, "update"])->name("api-tokens.update");
            Route::delete("/user/api-tokens/{token}", [ApiTokenController::class, "destroy"])->name("api-tokens.destroy");
        }

        // Teams...
        if (Jetstream::hasTeamFeatures()) {
            Route::post("/teams", [CongregationController::class, "store"])->name("teams.store");
            Route::get("/settings/congregations/{team}", [CongregationController::class, "show"])->name("teams.show");
            Route::put("/teams/{team}", [CongregationController::class, "update"])->name("teams.update");
            Route::delete("/teams/{team}", [CongregationController::class, "destroy"])->name("teams.destroy");
            Route::put("/current-team", [CurrentTeamController::class, "update"])->name("current-team.update");
            Route::post("/teams/{team}/members", [TeamMemberController::class, "store"])->name("team-members.store");
            Route::put("/teams/{team}/members/{user}", [TeamMemberController::class, "update"])->name("team-members.update");
            Route::delete("/teams/{team}/members/{user}", [TeamMemberController::class, "destroy"])->name("team-members.destroy");

            Route::get("/team-invitations/{invitation}", [TeamInvitationController::class, "accept"])
                ->middleware(["signed"])
                ->name("team-invitations.accept");

            Route::delete("/team-invitations/{invitation}", [TeamInvitationController::class, "destroy"])->name("team-invitations.destroy");
        }
    });
});
