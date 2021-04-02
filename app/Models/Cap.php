<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cap extends Model
{
    /**
     * Allow assigning anything by default.
     *
     * @var bool
     */
    protected static $unguarded = true;

    public function rate()
    {
        return $this->belongsTo(Rate::class, 'rate_id');
    }
}