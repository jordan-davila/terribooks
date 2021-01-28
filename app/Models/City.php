<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function territories()
    {
        return $this->hasMany(Territory::class)->orderByRaw("CAST(`order` AS UNSIGNED) ASC");
    }

    public function congregation()
    {
        return $this->belongsTo(Congregation::class);
    }
}
