<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date_order' => fake()->dateTimeThisYear('now'),
            'status' => fake()->randomElement(array('O', 'C')),
            'subtotal_products' => fake()->randomFloat(2, 0, 200),
            'discount' => fake()->randomFloat(2, 0, 10),
            'addition' => fake()->randomFloat(2, 0, 10),
            'total' => fake()->randomFloat(2, 0, 241),
        ];
    }
}
