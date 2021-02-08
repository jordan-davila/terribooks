<?php

namespace App\Aspects;

use App\Models\House;
use Illuminate\Support\Collection;
use Spatie\Searchable\SearchAspect;

class FieldSearchAspect extends SearchAspect
{
    public static $searchType = 'Field';

    public function limit($limit): void
    {
        $this->limit = $limit;
    }

    public function getResults(string $term): Collection
    {
        $aspect = House::query()
            ->select(
                'houses.*',
                'streets.name as street_name',
                'streets.territory_id',
                'territories.order',
                'cities.name as city_name'
            )
            ->join('streets', 'houses.street_id', '=', 'streets.id')
            ->join('territories', 'streets.territory_id', '=', 'territories.id')
            ->join('cities', 'territories.city_id', '=', 'cities.id')
            ->where('cities.team_id', '=', Auth()->user()->currentTeam->id)
            ->whereRaw(
                'CONCAT(houses.number, " ", streets.name) LIKE ?',
                ["%{$term}%"]
            );

        if ($this->limit) $aspect->limit($this->limit);
        return $aspect->get();
    }
}
