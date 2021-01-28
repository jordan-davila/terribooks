<?php

namespace Database\Factories;

use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApartmentFactory extends Factory
{
    protected $model = Apartment::class;

    public function definition()
    {
        static $number = 1;
	    $number = $number > 3 ? 1 : $number;
        return [
            'number' => $number++,
        ];
    }
}
