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
        $categoryArr = ['news' => 0 , 'promotion' => 1];
        $category = $request->query->get('category'. '');
        $lang = $request->get('lang', config('constants.default_language'));
        if(!empty($category)) {
            $builder->where('news.category', $categoryArr[$category]);
        }
        $builder->join('news_translations as trans', 'news.id', '=', 'trans.news_id')->where('trans.lang', '=', $lang);
    }

    public function show($news, $request)
    {
        $lang = $request->get('lang', config('constants.default_language'));
        return $this->with($this->getModelProperties($request))
            ->leftJoin('news_translations as trans', function ($q) use ($lang) {
                $q->on('news.id', '=', 'trans.news_id')
                    ->where('trans.lang', '=', $lang);
            })
            ->find($news->id);
    }
}
