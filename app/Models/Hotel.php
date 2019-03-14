<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function trans()
    {
        return $this->hasMany(HotelTranslation::class);
    }

    public function countryInfo()
    {
        return $this->belongsTo(Country::class);
    }

    public function delete()
    {
        $this->trans()->delete();
        $this->images()->delete();
        return parent::delete();
    }
}
