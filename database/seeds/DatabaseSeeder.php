<?php

use App\Models\Rate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Rate::create([
            'price_per_minute' => 20/3,
            'price_per_distance' => 0,
            'free_distance' => 0
        ]);
        Rate::create([
            'price_per_minute' => 25,
            'price_per_distance' => 50,
            'daily_cap' => 8500,
            'free_distance' => 50
        ]);
    }
}
