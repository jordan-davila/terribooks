<?php

namespace App\Aspects;

use App\Models\Phone;
use Illuminate\Support\Collection;
use Spatie\Searchable\SearchAspect;

class PhoneSearchAspect extends SearchAspect
{
    public static $searchType = 'Phone';

    public function limit($limit): void
    {
        $this->limit = $limit;
    }

    public function getResults(string $term): Collection
    {
        $aspect = Phone::query()
            ->select(
                'phones.*',
                'streets.name as street_name',
                'streets.territory_id',
                'territories.order',
                'cities.name as city_name'
            )
            ->join('streets', 'phones.street_id', '=', 'streets.id')
            ->join('territories', 'streets.territory_id', '=', 'territories.id')
            ->join('cities', 'territories.city_id', '=', 'cities.id')
            ->where(function ($query) use ($term) {
                $query
                    ->where('cities.team_id', '=', Auth()->user()->currentTeam->id)
                    ->whereRaw('phones.phone LIKE ?', ["%{$term}%"]);
            })
            ->orWhere(function ($query) use ($term) {
                $query
                    ->where('cities.team_id', '=', Auth()->user()->currentTeam->id)
                    ->whereRaw('phones.name LIKE ?', ["%{$term}%"]);
            });

        if ($this->limit) $aspect->limit($this->limit);
        return $aspect->get();
    }
}
