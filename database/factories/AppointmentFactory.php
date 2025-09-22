<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Business;
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'notes' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'business_id' => Business::inRandomOrder()->first()?->id,
            'user_id' => User::inRandomOrder()->first()?->id,
            'service_id' => Service::inRandomOrder()->first()?->id,
        ];
    }
}
