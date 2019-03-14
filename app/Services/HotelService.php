<?php
namespace Honviettour\Services;

use Honviettour\Models\Hotel;
use Honviettour\Traits\PaginatorTrait;
use Api;

class HotelService
{
    use PaginatorTrait;

    public function search($request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $refSortType = $sortType == 'asc' ? 'sortBy' : 'sortByDesc';
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));

        $builder = Hotel::with(['trans', 'images'])->orderBy($sortBy, $sortType);
        return self::paginate($builder, $limit);
    }

    /**
     * Add new Hotel
     *
     * @param Request $request
     *
     * @return Hotel
     */
    public function createHotel($request)
    {
        $input = $request->all();
        return Hotel::create($input);
    }

    /**
     * Update Hotel
     *
     * @param Request $request
     * @param Hotel $tour
     *
     * @return Hotel
     */
    public function updateHotel($request, $tour)
    {
        $tour->keyword = str_slug($request->subject);
        $this->validate($tour->toArray());
        $tour->save();

        return $tour;
    }

}
