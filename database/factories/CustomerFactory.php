<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'cpf' => fake('pt_BR')->cpf(),
            'rg' => fake('pt_BR')->rg(),
            'cellphone' => fake('pt_BR')->cellphoneNumber(),
            'telephone' => fake('pt_BR')->cellphoneNumber(),
        ];
    }
}
