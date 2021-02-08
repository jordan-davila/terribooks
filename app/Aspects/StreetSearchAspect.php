<?php

namespace App\Aspects;

use App\Models\Street;
use Illuminate\Support\Collection;
use Spatie\Searchable\SearchAspect;

class StreetSearchAspect extends SearchAspect
{
    public static $searchType = 'Street';

    public function limit($limit): void
    {
        $this->limit = $limit;
    }

    public function getResults(string $term): Collection
    {
        $aspect = Street::query()
            ->select(
                'streets.id as street_id',
                'streets.name as street_name',
                'streets.territory_id',
                'territories.order',
                'cities.name as city_name'
            )
            ->join('territories', 'streets.territory_id', '=', 'territories.id')
            ->join('cities', 'territories.city_id', '=', 'cities.id')
            ->where('cities.team_id', '=', Auth()->user()->currentTeam->id)
            ->whereRaw('streets.name LIKE ?', ["%{$term}%"]);

        if ($this->limit) $aspect->limit($this->limit);
        return $aspect->get();
    }
}
