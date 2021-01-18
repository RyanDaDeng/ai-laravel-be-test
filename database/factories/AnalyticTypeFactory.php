<?php

namespace Database\Factories;

use App\Models\AnalyticType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AnalyticTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnalyticType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'units' => $this->faker->name,
            'is_numeric' => true,
            'num_decimal_places' => 2
        ];
    }
}
