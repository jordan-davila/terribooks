<?php

namespace Database\Factories;

use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    protected $model = Publisher::class;

    public function definition()
    {
        return [
            "email" => $this->faker->unique()->safeEmail,
            "phone" => $this->faker->tollFreePhoneNumber,
        ];
    }
}
