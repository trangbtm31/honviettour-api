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
        if($request->getRelation) {
            $transAttrs = ['lang', 'title', 'description'];
            $data = Arr::only(parent::toArray($request), ['id', 'date', 'status', 'trans', 'photo', 'gallery']);
            if(!empty($data['trans'])) {
                foreach ($data['trans'][0] as $key => $value) {
                    in_array($key, $transAttrs) and $data[$key] = $value;
                }
            }
            unset($data['trans']);
        } else {
            $data = Arr::only(parent::toArray($request), ['id', 'date', 'status', 'trans', 'lang', 'title', 'description', 'photo', 'gallery']);
        }
        ksort($data);
        return $data;
    }
}
