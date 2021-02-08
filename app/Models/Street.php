<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model implements Searchable
{
    use HasFactory;

    protected $guarded = [
        'id', 'city_id'
    ];

    public function houses()
    {
        return $this->hasMany(House::class)->orderByRaw("CAST(`number` AS UNSIGNED) ASC");
    }

    public function phones()
    {
        return $this->hasMany(Phone::class)
            ->orderByRaw("CAST(`number` AS UNSIGNED) ASC")
            ->orderByRaw("CAST(`apartment` AS UNSIGNED) ASC");
    }

    public function businesses()
    {
        return $this->hasMany(Business::class)->orderByRaw("CAST(`number` AS UNSIGNED) ASC");
    }

    public function territory()
    {
        return $this->belongsTo(Territory::class);
    }

    public function getHouseCountAttribute()
    {
        return $this->houses->count();
    }

    public function getPhoneCountAttribute()
    {
        return $this->phones->count();
    }

    public function getBusinessCountAttribute()
    {
        return $this->businesses->count();
    }

    public function getSearchResult(): SearchResult
    {
        $route = "territories.editor.field.show";
        return new SearchResult($this, "Street", $route);
    }
}
