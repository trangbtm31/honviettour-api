<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class PlanResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = Arr::only(parent::toArray($request), ['id', 'date', 'status', 'trans', 'lang', 'title', 'description']);
        $data['photo'] = $this->photo ? env('APP_URL') . '/storage/' . $this->photo : '';
        $data['gallery'] = $this->gallery ? array_map(function($item) {
            return env('APP_URL') . '/storage/' . $item;
        }, $this->gallery) : [];
        return $data;
    }
}
