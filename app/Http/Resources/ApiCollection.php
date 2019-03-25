<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $mainKey = $request->name ?: 'data';

        if($request->getRelation) {
            return $this->collection;
        }
        return [
            $mainKey => $this->collection,
            'pagination' => $this->getPaginationMeta($this)
        ];
    }

    /**
     * Get collection of pagination meta data
     *
     * @param ResourceCollection $object
     * @return array
     */
    protected function getPaginationMeta(ResourceCollection $object)
    {
        return [
            'current_page' => $object->currentPage(),
            'hasMorePages' => $object->hasMorePages(),
            'first_page_url' => $object->url(1),
            'last_page' => $object->lastPage(),
            'last_page_url' => $object->url($object->lastPage()),
            'prev_page_url' => $object->previousPageUrl(),
            'next_page_url' => $object->nextPageUrl(),
            'per_page' => $object->perPage(),
            'from' => $object->firstItem(),
            'to' => $object->lastItem(),
            'total' => $object->total()
        ];
    }
}
