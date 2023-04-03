<?php

namespace Database\Factories;

use App\Models\Estations;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstationsFactory extends Factory
{
    protected $model = Estations::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'opening_hours' => $this->faker->time('H:i'),
            'closing_hours' => $this->faker->time('H:i'),
        ];
    }
}
