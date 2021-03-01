<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Territory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assignment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        // "date_in" => "datetime:m/d/Y",
        // "date_out" => "datetime:m/d/Y",
    ];

    public function territory()
    {
        return $this->belongsTo(Territory::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    // public function setDateInAttribute($value)
    // {
    //     $this->attributes["date_in"] = (new Carbon($value))->toFormattedDateString();
    // }
}
