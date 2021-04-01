<?php

use App\Models\Rate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Rate::create(['price_per_minute' => 20/3, 'price_per_distance' => 0]);
    }
}
