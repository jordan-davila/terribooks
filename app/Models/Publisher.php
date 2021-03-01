<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function getAssignmentCountAttribute()
    {
        return $this->assignments->count();
    }

    public function getAvatarAttribute()
    {
        return $this->stringToColor($this->name, 70, 95);
    }

    public function getInitialsAttribute()
    {
        return getInitials($this->name);
    }

    public function stringToColor($string, $saturation, $lightness)
    {
        $hash = 0;

        for ($i = 0; $i < strlen($string); $i++) {
            $utf16 = mb_convert_encoding($string, "UTF-16LE", "UTF-8");
            $charcodeat = ord($utf16[$i * 2]) + (ord($utf16[$i * 2 + 1]) << 8);
            $hash = $charcodeat + (($hash << 5) - $hash);
        }

        $hue = $hash % 360;
        return "hsl(" . $hue . ", " . $saturation . "%, " . $lightness . "%)";
    }
}
