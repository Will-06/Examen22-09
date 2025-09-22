<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = \App\Models\Service::class;


    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->word(),
            'recommendations' => $this->faker->word(),
            'abbreviation' => $this->faker->word(),
            'status_id' => Status::inRandomOrder()->first()?->id,
            'category_id' => Category::inRandomOrder()->first()?->id,
            'business_id' => Business::inRandomOrder()->first()?->id,
        ];
        
    }
}
