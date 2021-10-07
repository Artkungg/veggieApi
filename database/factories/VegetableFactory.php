<?php

namespace Database\Factories;

use App\Models\Vegetable;
use Illuminate\Database\Eloquent\Factories\Factory;

class VegetableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vegetable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'weight' => $this->faker->numberBetween(1,5),
            'price' => $this->faker->numberBetween(30,100)
        ];
    }
}
