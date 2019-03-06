<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Models\Tour;

class Plan extends Model
{
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }
}
