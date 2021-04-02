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

        $timeOutput = 0;
        $tempStart = $start->copy();
        while ($tempStart->lessThan($end)) {
            $period = $this
                ->rate
                ->periods()
//                ->whereJsonContains('months_in_year', $time->month)
//                ->whereJsonContains('days_in_month', $time->day)
//                ->whereJsonContains('days_in_week', $time->dayOfWeek)
                ->where('start', '<=', $tempStart->timestamp)
                ->where('end', '>=', $tempStart->timestamp)
                ->first();
            $periodEnd = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $tempStart->toDateString().' '.$period->end
            );
            $periodEnd->addMinutes(1);
            if ($periodEnd->lessThanOrEqualTo($end)) {
                $minutes = $tempStart->diffInMinutes($periodEnd, true);
            } else {
                $minutes = $tempStart->diffInMinutes($end, true);
            }
            //Increment caps
            //Increment running total
            $timeOutput += $minutes * $period->price_per_minute;
            $tempStart = $periodEnd->copy();
        }

        $tempDistance = 0;
        $distanceOutput = 0;
        while ($tempDistance <= $distance) {
            $range = $this
                ->rate
                ->ranges()
                ->whereNotNull('end')
                ->where('start', '<=', $tempDistance)
                ->where('end', '>=', $tempDistance)
                ->orWhere(function ($query) use ($tempDistance) {
                    $query->where('start', '<=', $tempDistance)->whereNull('end');
                })
                ->orderBy('start')
                ->first()
            ;
            if ($range->end === null || ($range->end !== null && $range->end >= $distance)) {
                $distanceOutput += ($distance - $range->start) * $range->price_per_distance;
            } else {
                $distanceOutput += ($range->end - $range->start) * $range->price_per_distance;
            }
            if ($range->end === null) {
                $tempDistance = $distance + 1;
            } else {
                $tempDistance = $range->end + 1;
            }
        }
        return new Result($timeOutput, new Distance($distanceOutput));
    }
}
