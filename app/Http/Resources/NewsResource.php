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
        $data = Arr::only(parent::toArray($request), ['id', 'category', 'image', 'code', 'expire_date', 'status', 'lang', 'title', 'content', 'created_at', 'news_category']);
        $data['category_name'] = !empty($data['news_category']['trans']) ? $data['news_category']['trans'][0]['name'] : '';
        unset($data['news_category']);
        return $data;
    }
}
