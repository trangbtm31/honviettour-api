<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Models\Hotel;

class Country extends Model
{
    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
