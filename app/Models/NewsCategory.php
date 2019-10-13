<?php

namespace Honviettour\Models;

use Honviettour\Contracts\HonviettourModelAbstract;

class NewsCategory extends HonviettourModelAbstract
{
    public function trans()
    {
        return $this->hasMany(NewsCategoryTranslation::class);
    }

    public function news()
    {
        return $this->hasMany(News::class, 'category');
    }

    protected function getModelProperties($request)
    {
        return;
    }

    protected function setQuery($builder, $request)
    {
        $lang = $request->get('lang', config('constants.default_language'));
        $builder->select('*', 'news_categories.id as id')->join('news_category_translations as trans', 'news_categories.id', '=', 'trans.news_category_id')->where('trans.lang', '=', $lang);
    }

    public function delete()
    {
        if(count($this->news)) {
            return false;
        }
        return parent::delete();
    }

}
