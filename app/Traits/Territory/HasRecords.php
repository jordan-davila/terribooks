<?php

namespace App\Traits\Territory;

trait HasRecords
{
    public function ownsStreet($street)
    {
        return $this->streets->contains('id', $street->id);
    }

    public function ownsHouse($house)
    {
        return $this->houses->contains('id', $house->id);
    }

    public function ownsPhone($phone)
    {
        return $this->phones->contains('id', $phone->id);
    }

    public function ownsBusiness($business)
    {
        return $this->businesses->contains('id', $business->id);
    }
}
