<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'role_id' => Role::inRandomOrder()->first()?->id,
            'status_id' => Status::inRandomOrder()->first()?->id,
            'business_id' => Business::inRandomOrder()->first()?->id,
            'password' => Hash::make('password'), 
            'remember_token' => Str::random(10),
        ];
    }
}
