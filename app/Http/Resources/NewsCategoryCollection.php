<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCategoryCollection extends ApiCollection
{
    public $collects = 'Honviettour\Http\Resources\NewsCategoryResource';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
