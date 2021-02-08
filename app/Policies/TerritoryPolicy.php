<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\House;
use App\Models\User;
use App\Models\Phone;
use App\Models\Street;
use App\Models\Territory;
use Illuminate\Auth\Access\HandlesAuthorization;

class TerritoryPolicy
{
    use HandlesAuthorization;

    public function handleTerritory(User $user, Territory $territory)
    {
        return $user->ownsTerritory($territory);
    }

    public function handleStreet(User $user, Territory $territory, Street $street)
    {
        return $territory->ownsStreet($street);
    }

    public function handleHouse(User $user, Territory $territory, House $house)
    {
        return $territory->ownsHouse($house);
    }

    public function handlePhone(User $user, Territory $territory, Phone $phone)
    {
        return $territory->ownsPhone($phone);
    }

    public function handleBusiness(User $user, Territory $territory, Business $business)
    {
        return $territory->ownsBusiness($business);
    }
}
