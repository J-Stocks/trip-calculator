<?php

use App\Models\Cap;
use App\Models\Period;
use App\Models\Range;
use App\Models\Rate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $idA = Rate::create()->id;
        Period::create([
            'rate_id' => $idA,
            'months_in_year' => '['.join(', ', range(1, 12)).']',
            'days_in_month' => '['.join(', ', range(1, 31)).']',
            'days_in_week' => '['.join(', ', range(1, 7)).']',
            'start' => '00:00:00',
            'end' => '23:59:00',
            'price_per_minute' => 20/3
        ]);
        Range::create([
            'rate_id' => $idA,
            'start' => 0,
            'price_per_distance' => 0
        ]);

        $idB = Rate::create()->id;
        Cap::create([
            'rate_id' => $idB,
            'type' => 'rolling',
            'duration' => 1440,
            'value' => 8500
        ]);
        Period::create([
            'rate_id' => $idB,
            'months_in_year' => '['.join(', ', range(1, 12)).']',
            'days_in_month' => '['.join(', ', range(1, 31)).']',
            'days_in_week' => '['.join(', ', range(1, 7)).']',
            'start' => '00:00:00',
            'end' => '23:59:00',
            'price_per_minute' => 25
        ]);
        Range::create([
            'rate_id' => $idB,
            'start' => 0,
            'end' => 50,
            'price_per_distance' => 0
        ]);
        Range::create([
            'rate_id' => $idB,
            'start' => 51,
            'price_per_distance' => 50
        ]);

        $idC = Rate::create()->id;
        Cap::create([
            'rate_id' => $idC,
            'type' => 'daily',
            'value' => 3900
        ]);
        Cap::create([
            'rate_id' => $idC,
            'type' => 'interval',
            'start' => '21:00:00',
            'end' => '06:00:00',
            'value' => 1200
        ]);
        Period::create([
            'rate_id' => $idC,
            'months_in_year' => '['.join(', ', range(1, 12)).']',
            'days_in_month' => '['.join(', ', range(1, 31)).']',
            'days_in_week' => '[6, 7]',
            'start' => '00:00:00',
            'end' => '23:59:00',
            'price_per_minute' => 10/3
        ]);
        Period::create([
            'rate_id' => $idC,
            'months_in_year' => '['.join(', ', range(1, 12)).']',
            'days_in_month' => '['.join(', ', range(1, 31)).']',
            'days_in_week' => '['.join(', ', range(1, 5)).']',
            'start' => '00:00:00',
            'end' => '06:59:00',
            'price_per_minute' => 20/3
        ]);
        Period::create([
            'rate_id' => $idC,
            'months_in_year' => '['.join(', ', range(1, 12)).']',
            'days_in_month' => '['.join(', ', range(1, 31)).']',
            'days_in_week' => '['.join(', ', range(1, 5)).']',
            'start' => '07:00:00',
            'end' => '18:59:00',
            'price_per_minute' => 133/12
        ]);
        Period::create([
            'rate_id' => $idC,
            'months_in_year' => '['.join(', ', range(1, 12)).']',
            'days_in_month' => '['.join(', ', range(1, 31)).']',
            'days_in_week' => '['.join(', ', range(1, 5)).']',
            'start' => '19:00:00',
            'end' => '23:59:00',
            'price_per_minute' => 20/3
        ]);
    }
}
