<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->word(),
            'group' => $this->faker->word(),
            'status_id' => Status::inRandomOrder()->first()?->id,
        ];
    }
}
