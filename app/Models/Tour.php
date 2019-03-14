<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['start_place', 'available_number', 'start_date', 'end_date', 'status'];
    public $timestamps = true;

    public function prices()
    {
        return $this->hasMany(Price::class)->orderBy('type');
    }

    public function trans()
    {
        return $this->hasMany(TourTranslation::class)->orderBy('lang');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function delete()
    {
        $this->trans()->delete();
        $this->prices()->delete();
        $this->images()->delete();
        return parent::delete();
    }

}