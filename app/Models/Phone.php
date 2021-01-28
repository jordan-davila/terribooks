<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $appends = ["street_name"];

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
}
