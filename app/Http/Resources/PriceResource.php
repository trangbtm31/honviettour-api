<?php

namespace Honviettour\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PriceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->type,
            'value' => $this->value,
            'description' => $this->description,
            'from' => $this->from,
            'to' => $this->to
        ];
    }
}
