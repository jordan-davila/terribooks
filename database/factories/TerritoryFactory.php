<?php

namespace Database\Factories;

use App\Models\Territory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerritoryFactory extends Factory
{
    protected $model = Territory::class;

    public function definition()
    {
        static $increment = 1;

        return [
            'number' => $increment++
        ];
    }
}
