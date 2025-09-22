<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class StatusFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Excelente', 'Mas o menos', 'En esperaaa', 'Buen servicio...']),
            'description' => $this->faker->word(),
            'group' => $this->faker->randomElement(['grupo1', 'grupo2', 'grupo3']),
        ];
    }
}
