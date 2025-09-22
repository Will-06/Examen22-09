<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            StatusSeeder::class,
            RoleSeeder::class,
            PlanSeeder::class,
            CategorySeeder::class,
            BusinessSeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            CustomizationSeeder::class,
            AppointmentSeeder::class,
            AgendaSeeder::class,
        ]);
    }
}
