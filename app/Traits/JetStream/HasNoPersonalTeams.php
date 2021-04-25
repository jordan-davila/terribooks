<?php

namespace App\Traits\JetStream;

use Laravel\Jetstream\Jetstream;

trait HasNoPersonalTeams
{
    /**
     * Determine if the user owns the given team.
     *
     * @param  mixed  $team
     * @return bool
     */
    public function ownsTeam($team)
    {
        // return $this->id == $team->user_id;
        return $this->id == optional($team)->user_id;
    }

    /**
     * Determine if the given team is the current team.
     *
     * @param  mixed  $team
     * @return bool
     */
    public function isCurrentTeam($team)
    {
        // return $team->id === $this->currentTeam->id;
        return optional($team)->id === $this->currentTeam->id;
    }

    public function isAdmin($team)
    {
        return $this->teamRole(optional($team))->key == "admin";
    }

    public function belongsToTeam($team)
    {
        return $this->teams->contains(function ($t) use ($team) {
            return $t->id === optional($team)->id;
        }) || $this->ownsTeam($team);
    }

    public function currentTeam()
    {
        if (is_null($this->current_team_id) && $this->id) {
            $this->switchTeam($this->allTeams()->first());
        }
        return $this->belongsTo(Jetstream::teamModel(), "current_team_id");
    }
}
