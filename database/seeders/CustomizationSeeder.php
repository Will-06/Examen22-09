<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customization;

class CustomizationSeeder extends Seeder
{
    public function run(): void
    {
  
        Customization::factory()->count(10)->create();
    }
}
