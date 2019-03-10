<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function tours()
    {
        return $this->belongsToMany(Tour::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function trans()
    {
        return $this->hasMany(PlanTranslation::class);
    }
}
