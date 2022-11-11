<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AddressService>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => fake()->numberBetween(1, 10),
            'cep' => fake()->bothify('#####-###'),
            'address' => fake()->streetName(),
            'complement' => fake()->text('20'),
            'number' => fake()->randomNumber(3),
            'district' => fake('ne_NP')->district(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(''),
            'country' => fake()->country(),
            'ibge' => fake()->randomNumber(7),
            'gia' => null,
            'ddd' => fake()->randomNumber(2),
            'siafi' => fake()->randomNumber(4),
        ];
    }
}
