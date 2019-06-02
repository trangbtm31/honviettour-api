<?php

namespace Honviettour\Models;

use Honviettour\Contracts\HonviettourModelAbstract;
use Illuminate\Database\Eloquent\Model;

class News extends HonviettourModelAbstract
{
    protected $fillable = ['category', 'image', 'code', 'expire_date', 'status'];

    public function trans()
    {
        return $this->hasMany(NewsTranslation::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    protected function getModelProperties($request)
    {
        $lang = $request->query->get('lang', config('constants.default_language'));
        return [
            'trans' => function($query) use ($lang) {
                $query->where('lang', '=', $lang);
            }
        ];
    }


    protected function setQuery($builder, $request)
    {
        $category = $request->query->get('category'. '');
        $lang = $request->get('lang', config('constants.default_language'));
        $builder->join('news_translations as trans', 'news.id', '=', 'trans.news_id')->where('trans.lang', '=', $lang)->where('category', $category);
    }
}
