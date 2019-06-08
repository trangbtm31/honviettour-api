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
        $data = Arr::only(parent::toArray($request), ['id', 'start_place', 'country_id', 'available_number', 'start_date', 'end_date', 'status', 'lang', 'name', 'description', 'service', 'note', 'detail']);
        $request->getRelation = true;
        $data['country'] = $this->country ? $this->country->name : null;
        $plans = new PlanCollection($this->plans);
        foreach ($plans as $key => $plan) {
            if(!count($plan->trans)) {
                unset($plans[$key]);
            }
        }
        // $data['plans'] = new PlanCollection($this->plans);
        $data['plans'] = $plans;
        $data['prices'] = new PriceCollection($this->prices);
        $data['photo'] = $this->photo ? url('storage/' . $this->photo) : '';
        $data['gallery'] = $this->gallery ? array_map(function($item) {
            return url('storage/' . $item);
        }, $this->gallery) : [];
        return $data;
    }
}