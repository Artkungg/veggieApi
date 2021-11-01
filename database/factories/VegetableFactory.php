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
            'veg_name' => $this->faker->firstName(),
            'veg_weight' => $this->faker->numberBetween(10,100),
            'veg_price' => $this->faker->numberBetween(30,100),
            'description' => $this->faker->realText(60)
        ];
    }
}
