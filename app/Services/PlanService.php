<?php
namespace Honviettour\Services;

use Honviettour\Models\Plan;
use Honviettour\Traits\PaginatorTrait;
use Api;

class PlanService
{
    use PaginatorTrait;

    public function search($request)
    {
        $sortBy = $request->query->get('sortBy', 'id');
        $sortType = $request->query->get('sortType', 'asc');
        $refSortType = $sortType == 'asc' ? 'sortBy' : 'sortByDesc';
        $limit = $request->query->get('limit', config('constants.ADMIN_ITEM_PER_PAGE'));

        $builder = Plan::with(['trans', 'images'])->orderBy($sortBy, $sortType);
        return self::paginate($builder, $limit);
    }

    /**
     * Add new Plan
     *
     * @param Request $request
     *
     * @return Plan
     */
    public function create($request)
    {
        $input = $request->all();
        return Plan::create($input);
    }

    /**
     * Update Plan
     *
     * @param Request $request
     * @param Plan $tour
     *
     * @return Plan
     */
    public function update($request, $plan)
    {
        $tour->keyword = str_slug($request->subject);
        $this->validate($tour->toArray());
        $tour->save();

        return $tour;
    }

}
