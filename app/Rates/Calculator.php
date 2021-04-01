<?php

namespace App\Rates;

use App\Contracts\Calculator as CalculatorContract;
use App\Contracts\Result as ResultContract;
use App\Models\Rate;
use Carbon\Carbon;

class Calculator implements CalculatorContract
{
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
        $minutes = clamp($start)->diffInMinutes(clamp($end), true);
        return new Result(
            $minutes * $this->rate->price_per_minute,
            new Distance($distance * $this->rate->price_per_distance)
        );
    }
}
