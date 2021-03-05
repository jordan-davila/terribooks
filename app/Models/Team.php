<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Team extends JetstreamTeam
{
    use HasFactory;
    use CascadesDeletes;
    protected $cascadeDeletes = ["cities", "publishers", "assignments"];

    protected $casts = [
        "personal_team" => "boolean",
    ];

    protected $fillable = ["name", "personal_team"];

    protected $dispatchesEvents = [
        "created" => TeamCreated::class,
        "updated" => TeamUpdated::class,
        "deleted" => TeamDeleted::class,
    ];

    public function cities()
    {
        return $this->hasMany(City::class)->orderBy("id", "asc");
    }

    public function territories()
    {
        return $this->hasManyThrough(Territory::class, City::class);
    }

    public function publishers()
    {
        return $this->hasMany(Publisher::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function getTerritoryCountAttribute()
    {
        return $this->territories->count();
    }
}
