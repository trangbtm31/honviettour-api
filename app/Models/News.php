<?php

namespace Honviettour\Models;

use Honviettour\Contracts\HonviettourModelAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;

class News extends HonviettourModelAbstract
{
    protected $fillable = ['category', 'image', 'code', 'expire_date', 'status'];

    public const CATEGORY_APPLY_CODE = 'promotion|khuyến mãi';

    public function trans()
    {
        return $this->hasMany(NewsTranslation::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class, 'category');
    }

    public function getAllCategories()
    {
        return NewsCategory::select('news_categories.id', DB::raw('GROUP_CONCAT(trans.name ORDER BY lang asc SEPARATOR " | ") AS name'))
            ->join('news_category_translations AS trans', 'news_categories.id', '=', 'trans.news_category_id')
            ->groupBy('news_categories.id')
            ->orderBy('name', 'asc')
            ->get();
    }

    protected function getModelProperties($request)
    {
        $lang = $request->query->get('lang', config('constants.default_language'));
        return [
            'newsCategory.trans' => function($query) use ($lang) {
                $query->where('lang', '=', $lang);
            }
        ];
    }


    protected function setQuery($builder, $request)
    {
        $category = $request->query->get('category');
        $lang = $request->get('lang', config('constants.default_language'));
        $builder->select('*', 'news.id as id')
            ->join('news_translations as trans', 'news.id', '=', 'trans.news_id')
            ->where('trans.lang', '=', $lang);
        if(!empty($category)) {
            $builder->where('news.category', $category);
        }
    }

    public function show($news, $request)
    {
        $lang = $request->get('lang', config('constants.default_language'));
        return $this->with($this->getModelProperties($request))
            -> select('*', 'news.id as id')
            ->leftJoin('news_translations as trans', function ($q) use ($lang) {
                $q->on('news.id', '=', 'trans.news_id')
                    ->where('trans.lang', '=', $lang);
            })
            ->find($news->id);
    }
}
