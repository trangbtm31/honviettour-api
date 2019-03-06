<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Models\Price;
use Honviettour\Models\Plan;

class Tour extends Model
{
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }
}
