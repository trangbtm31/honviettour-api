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
        $categoryArr = ['news' , 'promotion'];
        $data = Arr::only(parent::toArray($request), ['id', 'category', 'image', 'code', 'expire_date', 'status', 'trans', 'created_at', 'title', 'lang', 'content']);
        $data['category'] = $categoryArr[$data['category']];
        return $data;
    }
}
