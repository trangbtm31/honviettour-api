<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlanCollection extends ApiCollection
{
    public $collects = 'Honviettour\Http\Resources\PlanResource';

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
