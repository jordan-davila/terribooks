<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class City extends Model
{
    use HasFactory;
    use CascadesDeletes;

    protected $cascadeDeletes = ["territories"];
    protected $guarded = [];

    public function territories()
    {
        return $this->hasMany(Territory::class)->orderByRaw("CAST(`order` AS UNSIGNED) ASC");
    }

    public function congregation()
    {
        return $this->belongsTo(Congregation::class);
    }
}
