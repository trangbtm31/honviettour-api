<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Arr;

class NewsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $transAttrs = ['title', 'lang', 'content'];
        $categoryArr = ['news' , 'promotion'];
        $data = Arr::only(parent::toArray($request), ['id', 'category', 'image', 'code', 'expire_date', 'status', 'trans', 'created_at']);
        if(!empty($data['trans'])) {
            foreach ($data['trans'][0] as $key => $value) {
                in_array($key, $transAttrs) and $data[$key] = $value;
            }
        }
        unset($data['trans']);
        $data['category'] = $categoryArr[$data['category']];
        return $data;
    }
}
