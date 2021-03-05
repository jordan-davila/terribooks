<?php

namespace App\Models;

use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Territory\HasTerritory;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use App\Traits\Jetstream\HasNoPersonalTeams;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasTerritory;
    use HasNoPersonalTeams {
        HasNoPersonalTeams::ownsTeam insteadof HasTeams;
        HasNoPersonalTeams::isCurrentTeam insteadof HasTeams;
    }
    use CascadesDeletes;

    protected $cascadeDeletes = ["teams"];
    protected $fillable = ["name", "email", "password"];

    protected $hidden = ["password", "remember_token", "two_factor_recovery_codes", "two_factor_secret"];

    protected $casts = [
        "email_verified_at" => "datetime",
    ];

    protected $appends = ["profile_photo_url"];
}
