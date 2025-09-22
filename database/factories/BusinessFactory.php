<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Plan;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(), 
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'status_id' => Status::inRandomOrder()->first()?->id,
            'category_id' => Category::inRandomOrder()->first()?->id,
            'plan_id' => Plan::inRandomOrder()->first()?->id,
        ];
    }
}
