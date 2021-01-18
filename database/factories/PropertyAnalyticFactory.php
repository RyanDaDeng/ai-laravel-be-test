<?php

namespace Database\Factories;

use App\Models\PropertyAnalytic;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyAnalyticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropertyAnalytic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name,
            'units' => $this->faker->name,
            'is_numeric' => $this->faker->boolean,
            'num_decimal_places' => $this->faker->randomNumber(),
        ];
    }
}
