<?php

namespace App\Http\Resources;

use App\Http\Resources\StreetResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TerritoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order' => $this->order,
            'code' => $this->code,
            'coordinates' => $this->coordinates,
            'city_name' => $this->city_name,
            'house_count' => $this->house_count,
            'phone_count' => $this->phone_count,
            'business_count' => $this->business_count,
            'apartment_count' => $this->apartment_count,
            'updated_at' => $this->updated_at,
            'streets' => StreetResource::collection($this->streets),
        ];
    }
}
