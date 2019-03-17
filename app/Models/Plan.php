<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Traits\PaginatorTrait;

class Plan extends Model
{
//    use PaginatorTrait;
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

    public function search($request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));

        $builder = $this->with(['trans', 'images'])->orderBy($sortBy, $sortType);
//        return self::paginate($builder, $limit);
        return $builder;
    }


}
