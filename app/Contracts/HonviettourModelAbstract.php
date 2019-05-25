<?php
namespace Honviettour\Contracts;

use Illuminate\Database\Eloquent\Model;
use Honviettour\Traits\PaginatorTrait;
use Illuminate\Http\Request;

abstract class HonviettourModelAbstract extends Model {

    use PaginatorTrait;
    abstract protected function getModelProperties($request);

    /******************
        (\ /)
        (-.-)
        (m m)
        /_|_\
    *******************/
    // Important! to apply conditions from different model
    abstract protected function setQuery($builder, $request);

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

    public function search(Request $request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));
        $builder = $this->with($this->getModelProperties($request))
            ->where('status', 1)
            ->orderBy($sortBy, $sortType);
        $this->setQuery($builder, $request);
        return self::apiPaginate($builder, $limit);
    }

    public function show($tour, $request)
    {
        return $this->with($this->getModelProperties($request))->find($tour->id);
    }
}
