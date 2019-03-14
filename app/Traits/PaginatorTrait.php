<?php

namespace Honviettour\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait PaginatorTrait
{
    /**
     * Add paginate to query builder
     *
     * @param \Illuminate\Database\Eloquent\Builder $collection
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function paginate($collection, int $limit = null): LengthAwarePaginator
    {
        (empty($limit) || $limit < 0) && $limit = config('constants.ADMIN_ITEM_PER_PAGE'); // In case we submit limit <= 0;
        return $collection->paginate($limit)->appends(request()->except(['page', 'sort', 'direction']));
    }
}
