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

    public function territory()
    {
        return $this->belongsTo(Territory::class)->orderByRaw("CAST(`order` AS UNSIGNED) ASC");
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
