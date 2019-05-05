<?php
namespace Honviettour\Contracts;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Traits\PaginatorTrait;

abstract class HonviettourModelAbstract extends Model {

    use PaginatorTrait;
    abstract protected function _getModelProperties($request);

    // For model has gallery only
    public function setGalleryAttribute($data)
    {
        if (is_array($data)) {
            $this->attributes['gallery'] = json_encode($data);
        }
    }

    public function getGalleryAttribute($data)
    {
        if($data) {
            return json_decode($data, true);
        }
    }

    public function search($request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));
        $condition = $request->query->get('condition', '');

        $builder = $this->with($this->_getModelProperties($request))->where('status', 1)->orderBy($sortBy, $sortType);
        if(!empty($condition)) {
            foreach($condition as $key => $value) {
                $builder = $builder->where($key, $value);
            }
        }
        return self::apiPaginate($builder, $limit);
    }

    public function show($tour, $request)
    {
        return $this->with($this->_getModelProperties($request))->find($tour->id);
    }
}
