<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Traits\PaginatorTrait;

class Tour extends Model
{
    use PaginatorTrait;
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


    public function search($request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));

        // $refSortType = $sortType == 'asc' ? 'sortBy' : 'sortByDesc';
        // $sortByExplode = explode('.', $sortBy);
        // $tours = Tour::with('trans')->take($limit)->get();

        /**
         * sortBy translation_tours properties
         * tour hasMany translation_tours, can not use usual orderBy method without joining 2 tables
         */
        /*if($sortByExplode[0] === 'trans') {
            $tours = $tours->{$refSortType}(function($v) use ($sortByExplode){
                $max = max(array_column($v->trans->toArray(), $sortByExplode[1]));
                return $max;
            });
        } else {
            $tours = $tours->{$refSortType}($sortBy);
        }
        return $tours;*/

        $builder = $this->with(['trans', 'images', 'prices', 'plans'])->orderBy($sortBy, $sortType);
        return self::paginate($builder, $limit);
    }

    public function delete()
    {
        $this->trans()->delete();
        $this->prices()->delete();
        $this->images()->delete();
        return parent::delete();
    }

}