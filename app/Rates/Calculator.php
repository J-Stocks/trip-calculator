<?php

namespace App\Rates;

use App\Contracts\Calculator as CalculatorContract;
use App\Contracts\Result as ResultContract;
use App\Models\Rate;
use Carbon\Carbon;

class Calculator implements CalculatorContract
{
    const MINUTES_PER_DAY = 1440;

    /**
     * The Rate that should be applied to this calculation.
     *
     * @var Rate
     */
    protected $rate;

    /**
     * Create a new Calculator.
     *
     * @param int $rateId
     */
    public function __construct(int $rateId)
    {
        $this->rate = Rate::find($rateId);
    }

    /**
     * Calculate our rates.
     *
     * @param \Carbon\Carbon $start
     * @param \Carbon\Carbon $end
     * @param int $distance
     *
     * @return \App\Contracts\Result
     */
    public function calculate(Carbon $start, Carbon $end, int $distance): ResultContract
    {
        $start = clamp($start);
        $end = clamp($end);
        $minutes = $start->diffInMinutes($end, true);
        $distanceOutput = max(
            0,
            ($distance - $this->rate->free_distance) * $this->rate->price_per_distance
        );
        if ($minutes < 15) {
            $value = 0;
        } else if ($this->rate->daily_cap === null) {
            $value = $minutes * $this->rate->price_per_minute;
        } else {
            $days = $start->diffInDays($end);
            $fullDays = min(
                $days * $this->rate->daily_cap,
                $days * static::MINUTES_PER_DAY * $this->rate->price_per_minute
            );
            $remainingMinutes = min(
                $this->rate->daily_cap,
                ($minutes % static::MINUTES_PER_DAY) * $this->rate->price_per_minute);
            $value = $fullDays + $remainingMinutes;
        }
        return new Result($value, new Distance($distanceOutput));
    }
}
