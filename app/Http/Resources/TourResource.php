<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class TourResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $transAttrs = ['lang', 'name', 'description', 'service', 'note', 'detail'];
        $data = Arr::only(parent::toArray($request), ['id', 'start_place', 'available_number', 'start_date', 'end_date', 'status', 'trans']);
        if(!empty($data['trans'])) {
            foreach ($data['trans'][0] as $key => $value) {
                in_array($key, $transAttrs) and $data[$key] = $value;
            }
        }
        unset($data['trans']);
        $request->getRelation = true;
        $data['plans'] = new PlanCollection($this->plans);
        $data['prices'] = new PriceCollection($this->prices);
        $data['photo'] = $this->photo ? env('APP_URL') . '/storage/' . $this->photo : '';
        $data['gallery'] = $this->gallery ? array_map(function($item) {
            return env('APP_URL') . '/storage/' . $item;
        }, $this->gallery) : [];
        return $data;
    }
}