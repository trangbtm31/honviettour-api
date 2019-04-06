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
        $transAttrs = ['lang', 'title', 'description'];
        $data = Arr::only(parent::toArray($request), ['date', 'status', 'trans']);
        if(!empty($data['trans'])) {
            foreach ($data['trans'][0] as $key => $value) {
                in_array($key, $transAttrs) and $data[$key] = $value;
            }
        }
        unset($data['trans']);
        $data['photo'] = $this->photo ? env('APP_URL') . '/storage/' . $this->photo : '';
        $data['gallery'] = $this->gallery ? array_map(function($item) {
            return env('APP_URL') . '/storage/' . $item;
        }, $this->gallery) : [];
        return $data;
    }
}
