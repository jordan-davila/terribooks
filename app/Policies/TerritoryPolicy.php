<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Territory;
use Illuminate\Auth\Access\HandlesAuthorization;

class TerritoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Territory  $territory
     * @return mixed
     */
    public function view(User $user, Territory $territory)
    {
        // return false;
        return $user->ownsTerritory($territory);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Territory  $territory
     * @return mixed
     */
    public function update(User $user, Territory $territory)
    {
        return $user->ownsTerritory($territory);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Territory  $territory
     * @return mixed
     */
    public function delete(User $user, Territory $territory)
    {
        return $user->ownsTerritory($territory);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Territory  $territory
     * @return mixed
     */
    public function restore(User $user, Territory $territory)
    {
        return $user->ownsTerritory($territory);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Territory  $territory
     * @return mixed
     */
    public function forceDelete(User $user, Territory $territory)
    {
        return $user->ownsTerritory($territory);
    }
}
