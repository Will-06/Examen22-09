<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\Business;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    protected $model = Agenda::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'schedule' => $this->faker->date(),
            'business_id' => Business::inRandomOrder()->first()?->id,
            'user_id' => User::inRandomOrder()->first()?->id,
            'service_id' => Service::inRandomOrder()->first()?->id,
        ];
    }
}
