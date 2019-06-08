<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Contracts\HonviettourModelAbstract;

class Plan extends HonviettourModelAbstract
{
    public $timestamps = true;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

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

    public function delete()
    {
        $this->trans()->delete();
        $this->images()->delete();
        return parent::delete();
    }

    /*public function searchs($request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $sortType = $request->query->get('sortType', 'asc');
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));

        $builder = $this->with($this->getModelProperties($request))->where('status', 1)->orderBy($sortBy, $sortType);
        return self::apiPaginate($builder, $limit);
    }*/

    protected function setQuery($builder, $request)
    {
        $builder->select('*', 'plans.id as id');
        $lang = $request->get('lang', config('constants.default_language'));
        $builder->join('plan_translations as trans', 'plans.id', '=', 'trans.plan_id')
            ->where('trans.lang', '=', $lang);
    }

    public function show($plan, $request)
    {
        $lang = $request->get('lang', config('constants.default_language'));
        return $this->select('*', 'plans.id as id')
            ->leftJoin('plan_translations as trans', function ($q) use ($lang) {
                $q->on('plans.id', '=', 'trans.plan_id')
                    ->where('trans.lang', '=', $lang);
            })
            ->find($plan->id);
    }

    protected function getModelProperties($request)
    {
        return;
    }

}
