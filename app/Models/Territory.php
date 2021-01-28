<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
    use HasFactory;

    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'created_at' => 'datetime:F d, Y',
        'updated_at' => 'datetime:F d, Y',
    ];

    protected $guarded = [
        'id', 'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function streets()
    {
        return $this->hasMany(Street::class)
            ->orderBy('order')
            ->orderBy('id', 'desc');
    }

    public function houses()
    {
        return $this->hasManyThrough(House::class, Street::class);
    }

    public function phones()
    {
        return $this->hasManyThrough(Phone::class, Street::class);
    }

    public function url()
    {
        return url('territory/' . $this->id);
    }

    public function getCodeAttribute()
    {
        return getInitials($this->city->name) . $this->order;
    }

    public function getNameAttribute()
    {
        return $this->city->name . ' ' . $this->order;
    }

    public function getCityNameAttribute()
    {
        return $this->city->name;
    }

    public function getHouseCountAttribute()
    {
        return $this->houses->count();
    }

    public function getPhoneCountAttribute()
    {
        return $this->phones->count();
    }

    public function getApartmentCountAttribute()
    {
        return $this->houses
            ->map(function ($house) {
                return $house->apartment_count;
            })
            ->sum();
    }
}
