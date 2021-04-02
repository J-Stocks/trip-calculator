<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    /**
     * Allow assigning anything by default.
     *
     * @var bool
     */
    protected static $unguarded = true;

    protected $casts = [
        'months_in_year' => 'array',
        'days_in_month' => 'array',
        'days_in_week' => 'array'
    ];

    public function rate()
    {
        return $this->belongsTo(Rate::class, 'rate_id');
    }
}