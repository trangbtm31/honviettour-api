<?php

namespace Honviettour\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategoryTranslation extends Model
{
    protected $fillable = ['name', 'lang', 'news_category_id'];

    public function NewsCategory()
    {
        return $this->belongsTo(NewsCategory::class);
    }
}