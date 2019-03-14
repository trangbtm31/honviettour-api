<?php
namespace Honviettour\Services;

use Honviettour\Contracts\ServiceInterface;
use Honviettour\Models\Tour;
use Honviettour\Traits\PaginatorTrait;
use Api;

class TourService implements ServiceInterface
{
    use PaginatorTrait;

    public function search($request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $refSortType = $sortType == 'asc' ? 'sortBy' : 'sortByDesc';
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));

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

        $builder = Tour::with(['trans', 'images', 'prices', 'plans'])->orderBy($sortBy, $sortType);
        return self::paginate($builder, $limit);
    }

    /**
     * Add new Tour
     *
     * @param Request $request
     *
     * @return Tour
     */
    public function create($request)
    {
        $input = $request->all();
        return Tour::create($input);
    }

    /**
     * Update Tour
     *
     * @param Request $request
     * @param Tour $tour
     *
     * @return Tour
     */
    public function update($request, $tour)
    {
        $tour->keyword = str_slug($request->subject);
        $this->validate($tour->toArray());
        $tour->save();

        return $tour;
    }

}
