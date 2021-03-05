<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class House extends Model implements Searchable
{
    use HasFactory;
    use CascadesDeletes;
    protected $guarded = [];
    protected $appends = ["apartment_count"];
    protected $cascadeDeletes = ["apartments"];

    public function apartments()
    {
        return $this->hasMany(Apartment::class)->orderByRaw("CAST(`number` AS UNSIGNED) ASC");
    }

    public function getApartmentCountAttribute()
    {
        return $this->apartments->count();
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function getSearchResult(): SearchResult
    {
        $route = "territories.editor.field.show";
        return new SearchResult($this, "Field", $route);
    }
}
