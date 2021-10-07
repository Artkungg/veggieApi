<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

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
            'price' => $this->faker->numberBetween(30,100),
            'cart_id' => $this->faker->numberBetween(1,2),
        ];
    }
}
