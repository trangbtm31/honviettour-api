<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Contracts\HonviettourModelAbstract;

class Tour extends HonviettourModelAbstract
{
    protected $fillable = ['start_place', 'available_number', 'start_date', 'end_date', 'status'];
    public $timestamps = true;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function prices()
    {
        return $this->morphMany(Price::class, 'model');
    }

    public function trans()
    {
        return $this->hasMany(TourTranslation::class)->orderBy('lang');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class)->orderBy('date', 'asc');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    protected function getModelProperties($request)
    {
        $lang = $request->query->get('lang', config('constants.default_language'));
        return [
            'prices',
            'country',
            'plans.trans' => function ($query) use ($lang) {
                $query->where('lang', '=', $lang);
            },
        ];
    }

    protected function setQuery($builder, $request)
    {
        $builder->select('*', 'tours.id as id');
        if (!empty($request->get('country'))) {
            $builder->where('country_id', $request->get('country'));
        }
        if (!empty($request->get('start_place'))) {
            $builder->where('start_place', $request->get('start_place'));
        }
        if (!empty($request->get('start_date'))) {
            $builder->where('start_date', $request->get('start_date'));
        }
        $lang = $request->get('lang', config('constants.default_language'));
        $builder->join('tour_translations as trans', 'tours.id', '=', 'trans.tour_id')
            ->where('trans.lang', '=', $lang);
    }

    public function show($tour, $request)
    {
        $lang = $request->get('lang', config('constants.default_language'));
        return $this->select('*', 'tours.id as id')
            ->with($this->getModelProperties($request))
            ->leftJoin('tour_translations as trans', function ($q) use ($lang) {
                $q->on('tours.id', '=', 'trans.tour_id')
                    ->where('trans.lang', '=', $lang);
            })
            ->find($tour->id);
    }

    public function delete()
    {
        $this->trans()->delete();
        $this->prices()->delete();
        $this->images()->delete();
        return parent::delete();
    }
}
