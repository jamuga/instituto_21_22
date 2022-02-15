<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CentroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->numberBetween(30000000, 30099999),
            'nombre' => 'I.E.S. ' . $this->faker->company(),
            'verificado' => 1,
            'web' => 'https://' . $this->faker->domainName()
        ];
    }
}
