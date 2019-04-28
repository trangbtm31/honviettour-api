<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class PromotionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        dd($this, $request);
        $arr = ['content', 'code', 'expire_date', 'image'];
        $data = [];
        foreach ($arr as $value) {
            $data[$value] = $this->$value;
        }
        $data['image'] = $this->image ? env('APP_URL') . '/storage/' . $this->image : '';
        return $data;
    }
}
