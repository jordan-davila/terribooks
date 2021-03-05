<?php

namespace App\Models;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model implements Searchable
{
    use HasFactory;
    protected $guarded = [];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function getSearchResult(): SearchResult
    {
        $route = "territories.editor.phone.show";
        return new SearchResult($this, "Phone", $route);
    }

    public function getAddressAttribute()
    {
        if (!empty($this->apartment)) {
            $apt = $this->apartment == "BSMT" ? $this->apartment : "APT " . $this->apartment;
        } else {
            $apt = "";
        }
        return trim($this->number . " " . $this->street->name . " " . $apt);
    }
}
