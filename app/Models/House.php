<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    // protected $appends = ['apartment_count'];

    public function apartments()
    {
        return $this->hasMany(Apartment::class)->orderByRaw("CAST(`number` AS UNSIGNED) ASC");
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

}
