<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function trans()
    {
        return $this->hasMany(TourTranslation::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

}
