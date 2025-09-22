<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomizationFactory extends Factory
{
    protected $model = \App\Models\Customization::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->word(),
            'facebook' => $this->faker->url(),
            'instagram' => $this->faker->url(),
            'whatsapp' => $this->faker->phoneNumber(),
            'business_id' => Business::inRandomOrder()->first()?->id,
        ];
    }
}
