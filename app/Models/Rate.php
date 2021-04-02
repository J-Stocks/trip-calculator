<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    /**
     * Allow assigning anything by default.
     *
     * @var bool
     */
    protected static $unguarded = true;

    public function caps()
    {
        return $this->hasMany(Cap::class);
    }

    public function periods()
    {
        return $this->hasMany(Period::class);
    }

    public function ranges()
    {
        return $this->hasMany(Range::class);
    }
}
