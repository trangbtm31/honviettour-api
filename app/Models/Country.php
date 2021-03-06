<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Models\Hotel;

class Country extends Model
{
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function getTourCountries() {
        return $this->select('countries.id','countries.name')
            ->distinct()
            ->join('tours', function($join) {
                $join->on('countries.id','=', 'tours.country_id');
            })
            ->orderBy('countries.name')->get();
    }
}
