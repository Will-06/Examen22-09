<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
class RoleFactory extends Factory
{

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Super admin', 'Vendedor', 'Comprador']),
            'description' => $this->faker->word(),
            'status_id' => Status::inRandomOrder()->first()?->id,
        ];
    }
}
