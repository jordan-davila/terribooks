<?php

namespace App\Traits\Territory;

trait HasTerritory
{
    public function ownsTerritory($territory)
    {
        return $this->currentTeam->territories->contains('id', $territory->id);
    }
}
