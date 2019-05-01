<?php

namespace Honviettour\Models;

use Honviettour\Contracts\HonviettourModelAbstract;
use Illuminate\Database\Eloquent\Model;

class News extends HonviettourModelAbstract
{
    protected $fillable = ['category', 'image', 'code', 'expire_date'];

    public function trans()
    {
        return $this->hasMany(NewsTranslation::class)->orderBy('lang');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    protected function _getModelProperties($request)
    {
        $lang = $request->query->get('lang', config('constants.default_language'));
        return [
            'trans' => function($query) use ($lang) {
                $query->where('lang', '=', $lang);
            }
        ];
    }
}
