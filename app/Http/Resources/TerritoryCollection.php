<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// To be used on Territory Picker
// Not to be confused with TerritoryResource
// For a more detailed Collection, use TerritoryResource
class TerritoryCollection extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "order" => $this->order,
            "code" => $this->code,
            "coordinates" => $this->coordinates,
            "city_id" => $this->city_id,
            "city_name" => $this->city_name,
            "house_count" => $this->house_count,
            "phone_count" => $this->phone_count,
        ];
    }
}
